<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DecryptionKeyEmail; 
use Illuminate\Support\Facades\Hash;
class TodosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('home', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_todo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);
    
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return back()->with('error', 'User with email ' . $email . ' not found.');
        }
    
        $decryptionKey = openssl_random_pseudo_bytes(16);
        $decryptionKeyString = base64_encode($decryptionKey);
        $encryptedMessage = openssl_encrypt($request->input('message'), 'AES-128-CBC', $decryptionKey, 0, $decryptionKey);
    
        $todo = new Todo;
        $todo->email = $email;
        $todo->message = $encryptedMessage;
        $todo->decryption_key = Hash::make($decryptionKeyString);
        $todo->user_id = $user->id;
        $todo->save();
    
        if (!$todo->decryption_key) {
            return back()->with('error', 'Error storing decryption key.');
        }
    
        Mail::to($email)->cc($user->email)->send(new DecryptionKeyEmail($decryptionKeyString));
    
        return back()->with('success', 'Message sent successfully and decryption key has been sent to ' . $email . '.');
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('delete_todo', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request)
    {
        $decryptionKey = $request->input('decryption_key');
        $todo = Todo::where('user_id', Auth::user()->id)->orderBy('id','desc')->first();
    
        if (!$todo) {
            return back()->with('error', 'User not found or decryption key is incorrect.');
        }
    
        $hashedDecryptionKey = $todo->decryption_key;
    
        if (Hash::check($decryptionKey, $hashedDecryptionKey)) {
            $decryptedMessage = openssl_decrypt($todo->message, 'AES-128-CBC', base64_decode($decryptionKey), 0, base64_decode($decryptionKey));
    
            if ($decryptedMessage === false) {
                return back()->with('error', 'Invalid decryption key');
            }
     
            $todo->decrypted_message = $decryptedMessage;
    
            return view('show', compact('todo'));
        } else {
            return back()->with('error', 'Invalid decryption key');
        }
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Item deleted successfully');
    }


    public function show_decryption(Request $request)
    {
    
        return view('show_decryption');
    }


}
