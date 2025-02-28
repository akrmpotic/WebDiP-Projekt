<?php

/*
 * The MIT License
 *
 * Copyright 2014 Matija Novak <matija.novak@foi.hr>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * Klasa za upravljanje sa sesijama
 *
 * @author Matija Novak <matija.novak@foi.hr>
 */

class Sesija {

    const KORISNIK = "korisnik";
    const KOSARICA = "kosarica";
    const SESSION_NAME = "prijava_sesija";
    const TIP = "uloga";
    const ID = "ulogiran";

    static function kreirajSesiju() {
        session_name(self::SESSION_NAME);

        if (session_id() == "") {
            session_start();
        }
    }

    static function kreirajKorisnika($korisnik,$uloga,$id_korisnika) {
        self::kreirajSesiju();
        $_SESSION[self::KORISNIK] = $korisnik;
        $_SESSION[self::TIP] = $uloga;
        $_SESSION[self::ID] = $id_korisnika;
    }

    static function kreirajKosaricu($kosarica) {
        self::kreirajSesiju();
        $_SESSION[self::KOSARICA] = $kosarica;
    }

    static function dajKorisnika() {
        self::kreirajSesiju();
        if (isset($_SESSION[self::KORISNIK])) {
            $korisnik = $_SESSION[self::KORISNIK];
        } else {
            return null;
        }
        return $korisnik;
    }

    static function dajTipKorisnika() {
        self::kreirajSesiju();
        if (isset($_SESSION[self::KORISNIK])) {
            $tip = $_SESSION[self::TIP];
        } else {
            return null;
        }
        return $tip;
    }

    static function dajIdKorisnika() {
        self::kreirajSesiju();
        if (isset($_SESSION[self::KORISNIK])) {
            $id = $_SESSION[self::ID];
        } else {
            return null;
        }
        return $id;
    }

    static function dajKosaricu() {
        self::kreirajSesiju();
        if (isset($_SESSION[self::KOSARICA])) {
            $kosarica = $_SESSION[self::KOSARICA];
        } else {
            return null;
        }
        return $kosarica;
    }

    /**
     * Odjavljuje korisnika tj. briše sesiju
     */
    static function obrisiSesiju() {
        session_name(self::SESSION_NAME);

        if (session_id() != "") {
            session_unset();
            session_destroy();
        }
    }

}
