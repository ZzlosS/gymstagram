# gymstagram

Kreiranje baze podataka.
  - u phpMyAdmin-u napraviti bazu sa imenom 'gym'.
  - u Privilages, dodati novog korisnika sa korisnickim imenom `gym`, sifrom `gym` i za host staviti 'localhost'. 
  - importovati SQL fajl 'gym.sql'.
  - sve fajlove smestiti u 'www' folder wamp server-a.
  - u bazi podataka se vec nalaze neki korisnici.
 
Opis
    Gymstagram je socialna mreza koja ima i mogucnost kreiranja nedeljnog/dnevnog plana treninga.
    
    - index.php - sadrzi pozdravnu poruku, informacije o autorima, i meni koji sadrzi tabove 'Home', 'Log In', 'Sign Up', 'Language' 
    
    - home.php - ukoliko se nalazite na stranici a niste ulogovani prikazace vam se samo public profili. U suprotnom, osim public profila, prikazuju se i profili osoba koje pratite.
    
    - login.php - sadrzi formu koja sluzi da se prijavite na Gymstagram. Mozete se prijaviti gym_ime-nom ili email-om. U slucaju da ste zaboravili lozinku, postoji link koji vas vodi na stranicu passchange.php.
    
    - passchange.php - sadrzi formu u kojoj da bi upisali novu lozinku morate da upiste svoja email i odgovorite na sigurnosna pitanja.
    
    - signup.php - sardzi formu za registraciju korisnika.
    
    - plan.php - kreiranje nedeljnog/dnevnog plana treninga
    
    - search.php - 
        - USER - ima mogucnost pretrag.
        - ADMIN - osim pretrage ima mogucnost da vidi sve korisnike.
    
    - control.php - ADMIN 
        - stranica koju vidi samo ADMIN, koji moze menjati dozvole korisnicima. (ADMIN, USER, BAN)
    
    - log.php - ADMIN
        - stranica koja prikazuje dinamicku log tabelu
    
    - log_pdf.php - log_html.php - log_docx.php - ADMIN
        - dostupno samo za admina, generise se PDF, HTML ili DOCX
    
    - profile.php -
        - sadrzi informacije o korisniku, link ka galeriji i informacije o tome koliko korisnika prati a koliko korisnika njega prate.
    
    - gallery.php -
        - mogucnost postavljanja, brisanja i pregled slika.
    
    - changeP.php -
        - omogucuje izmenu podataka i postavljanje profilne slike.
        
      
