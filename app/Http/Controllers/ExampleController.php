<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ExampleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function table()
    {
        $users = User::all();
        return view('layouts.table-example', compact ('users') );
    }

    public function clock()
    {
        return view('layouts.clock-example');
    }

    public function chart()
    {
        return view('layouts.chart-example');
    }

    public function form()
    {
        return view('layouts.form-example');
    }

    public function map()
    {
        return view('layouts.map-example');
    }

    public function calendar()
    {
        return view('layouts.calendar-example');
    }

    public function gallery()
    {
        return view('layouts.gallery-example');
    }

    public function todo()
    {
        return view('layouts.todo-example');
    }

    public function contact()
    {
        return view('layouts.contact-example');
    }

    public function faq()
    {
        return view('layouts.faq-example');
    }

    public function news()
    {
        return view('layouts.news-example');
    }

    public function about()
    {
        return view('layouts.about-example');
    }

    // Hapus user
    public function destroy(User $user)
    {
        // Hapus user berdasarkan ID
        $user->delete();

        // Redirect kembali ke halaman tabel dengan pesan sukses
        return redirect()->route('layouts.table-example')->with('success', 'User berhasil dihapus!');
    }
}

