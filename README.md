#KCS WEB Kurso medžiaga
##Kaip pradėti naudotis?
Pieš pradedant naudotis Terminalu privalote mokėti naudotis juo.
Čia trumpas Video: https://www.youtube.com/watch?v=Vhcx4KJbtes

* Instaliuokite Git ([instrukcija](https://git-scm.com/downloads))
* Instaliuokite Composer (instrukcija [Win](https://getcomposer.org/doc/00-intro.md#using-the-installer) | [Mac](https://duvien.com/blog/installing-composer-mac-osx))
* Instaliuokite Docker ([instrukcija](https://docs.docker.com/install/) | [WIn 10](https://docs.docker.com/docker-for-windows/install-windows-home/)) (Reikalavimas [Windows 10 2004 versija](https://docs.microsoft.com/en-us/windows/wsl/install-win10))
* Terminale rašykite: 
  * `composer --stability=dev create-project kaunas-coding-school/web`
 po sėkmingo projekto sukūrimo matysite klausimą `Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]?` spauskite `ENTER` klavišą
  * Toliau terminale rašykite`cd web`
  * `docker-compose up -d`
  * `docker-compose exec web composer install`  

** Kitus kartus tereikia Terminale kur kūrėte Projektą leisti komandą:
  * `docker-compose up -d` 

### Projekto failų architektūra
```
project
|--- Docker (Dokerio komteinerių konfigūraciniai failai)
|--- public_html (Viešai prieinami failai matomi lankytojams)
|--- src (Aplikacijos išeities kodo failai)
|--- vendor (Bibliotekų failai)
```