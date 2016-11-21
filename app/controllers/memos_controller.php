<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MemoController extends BaseController {

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        $memos = Memo::all(); // get memos
        // Kint::dump($memos);
        View::make('home.html', array('memos' => $memos)); // render view
    }

    public static function categories() {

        View::make('categories.html');
    }

    public static function memos() {

        View::make('memos.html');
    }

    public static function create() {

        View::make('new.html');
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Memo-luokan olion käyttäjän syöttämillä arvoilla
        $memo = new Memo(array(
            'title' => $params['title'],
            'content' => $params['content'],
            'priority' => $params['priority']
        ));

        Kint::dump($params);

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $memo->save();
        // Ohjataan käyttäjä lisäyksen jälkeen muistion esittelysivulle
        Redirect::to('/', array('message' => 'Uusi muistio lisätty'));
    }

}
