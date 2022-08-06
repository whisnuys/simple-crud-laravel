<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function login_form()
    {
        return view('login');
    }


    // handle login
    public function login_action(Request $request) // ambil data dari post
    {
        // $hashed_password = Hash::check //decrypt password
        $users = Users::where('username', $request->username)->first(); //ambil dan cari username dari request
        if ($users == null) {
            return redirect()->back()->with('error', 'maaf username tidak ditemukan'); //jika tidak ada kembalikan ke form
        }
        $db_password = $users->password; //ambil password dari user yang di db
        $hashed_password = Hash::check($request->password, $db_password); // decrypt dan compare password post dengan yang ada di db 
        if ($hashed_password) {
            // jika comparenya sama atau true
            $users->token = Str::random(20); // menambahkan token yang null akan terisi jika berhasil login
            $users->save(); //save ke tabel user
            $request->session()->put('token', $users->token); // jika user login maka simpan session di backend dan taruh dengan nama token dan valuenya token yang ada di db dan tetap ada selama belum di destroy
            return to_route('dashboard_index')->with('success', 'Berhasil login dengan user : ' . $users->username);
        } else {
            return redirect()->back()->with('error', 'maaf data anda tidak sesuai');
        }
    }

    public function register_form()
    {
        return view('register');
    }

    public function register_action(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required'],
        ]);

        $register = Users::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        if ($register) {
            return to_route('login_form')->with('success', 'Registrasi berhasil, silahkan login');
        }
    }

    public function dashboard_index()
    {
        // handle bypass dashboard
        if (FacadesSession::has('token')) {

            // Reset id tabel
            DB::statement("SET @count = 0;");
            DB::statement("UPDATE `articles` SET `articles`.`id` = @count:= @count + 1;");
            DB::statement("ALTER TABLE `articles` AUTO_INCREMENT = 1;");

            $users = Users::where('token', FacadesSession::get('token'))->first();
            $articles = Articles::get();
            return view('Dashboard/index', [
                'title' => 'Welcome to Dashboard Admin',
                'users' => $users,
                'articles' => $articles,
            ]); //passing data
        } else {
            return redirect()->back();
        }
    }

    // handle logout
    public function dashboard_logout(Request $request)
    {
        Users::where('token', $request->token)->update([
            'token' => NULL //update data di tabel menjadi null
        ]);

        FacadesSession::pull('token');
        return to_route('login_form');
    }

    // handle article delete
    public function article_delete_action(Request $request)
    {

        Articles::find($request->id)->delete();
        return redirect()->back()->with('success', 'artikel berhasil di hapus');
    }
    // handle article add
    public function article_add_action(Request $request)
    {
        // handle validasi
        $request->validate([
            'title' => ['required', 'max:255', 'min:5'],
            'description' => ['required', 'min:20'],
            'tag' => ['nullable'],
        ]);

        $created = Articles::create([
            'title' => $request->title,
            'description' => $request->description,
            'tag' => $request->tag,
        ]);
        if ($created) {
            return redirect()->back()->with('success', 'artikel baru berhasil di buat');
        }
    }

    // handle get edit article
    public function article_edit_action($id)
    {
        return view('edit', [
            'title' => 'Edit Article dengan id-' . $id,
            'article' => Articles::find($id),
        ]);
    }
    // handle update article
    public function article_update_action($id, Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'min:5'],
            'description' => ['required', 'min:20'],
            'tag' => ['nullable'],
        ]);
        $article = Articles::find($id);
        $article->update($request->except(['_token', 'submit'])); // update kecuali _token dari csrf dan sumbit
        return to_route('dashboard_index')->with('success', 'Artikel berhasil di update');
    }
}
