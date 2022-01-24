#KCS WEB Kurso medžiaga

##Kaip pradėti naudotis?

Pieš pradedant naudotis Terminalu privalote mokėti naudotis juo.
Čia trumpas Video: [instrukcija](https://www.youtube.com/watch?v=Vhcx4KJbtes)

* Instaliuokite Git ([instrukcija](https://git-scm.com/downloads))
* Instaliuokite Docker ([instrukcija](https://docs.docker.com/install/) | [WIn 10](https://docs.docker.com/docker-for-windows/install-windows-home/)) (Reikalavimas [Windows 10 2004 versija](https://docs.microsoft.com/en-us/windows/wsl/install-win10))
* Terminale rašykite: 
  * Pirma su terminalu nukeliaukite į vartotojo [Desktop] katalogą. (Žiūrėti [instrukcija](https://www.youtube.com/watch?v=Vhcx4KJbtes))
  * `git clone git@github.com:kaunas-coding-school/webKursas.git klases_darbas`
  * Toliau terminale rašykite`cd klases_darbas`
  * `docker compose up -d`

** Kitus kartus tereikia Terminale, kur kūrėte Projektą, paleisti komandą:
  * `docker compose up -d` 

### Projekto failų architektūra
```
configs (Dokerio konteinerių konfigūraciniai failai)
db (duomenų bazės failai)
projecto_failai
|--- public_html (Viešai prieinami failai matomi lankytojams)
|--- src (Aplikacijos išeities kodo failai)
|--- vendor (Bibliotekų failai)
edit_hosts_file.bat (Failas koreguojantis hosts failą Windows OS)
```