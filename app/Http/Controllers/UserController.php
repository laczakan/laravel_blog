<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;

class UserController extends Controller
{
    //user profile
    public function show(User $user)
    {
        $articles = $user->articles()->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();

        return view('users.profile')
            ->with('articles', $articles)
            ->with('categories', $categories);
    }

    // User register form
    public function create()
    {
        return view('users.create');
    }

    // Save user to database
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:32'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:4', 'max:32'],
            'password_confirmation' => ['required', 'min:4', 'max:32'],
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/auth/login')->with('success', 'New User registered. You can login now!');
    }

    // Show All Users articles
    public function article(User $user)
    {
        $articles = $user->articles()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.article')
            ->with('user', $user)
            ->with('articles', $articles);
    }

    // Add image form
    public function image(User $user)
    {
        return view('users.image');
    }

    // Save user image in database
    public function storeImage(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'image' => ['image', 'nullable', 'max:1999']]);

        if ($request->hasFile('image')) {
            //get just extention
            $extention = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = uniqid() . '.' . $extention;

            $path = $request->file('image')->storeAs('public/upload/users', $fileNameToStore);
        } else {
            $fileNameToStore = null;
        }

        if ($user->image) {
            unlink('storage/upload/users/' . $user->image);
        }

        $user->image = $fileNameToStore;
        $user->update();

        return redirect('users/' . Auth::id())->with('success', 'Image changed.');
    }

    // Delete users image
    public function deleteImage()
    {
        $user = Auth::user();

        $user->image = null;
        $user->update();


        return redirect('users/' . Auth::id())->with('success', 'Image deleted');
    }

}
