Postcode API
============

Met deze code kun je in een (RSFormPro) formulier gebruik maken van een adreslookup via Postcodeapi.nu.

Installatie insctructies:
* Vraag een API key aan via http://www.postcodeapi.nu
* Plaats jouw API key in bestand pcget.php regel 37.
* Plaats bestand pcget.php in de map /media/postcode
* Plaats bestand postcode.js in de map /media/postcode
* Maak een formulier met de velden "postcode" "huisnummer" "straat" "plaats" "provincie" "lat" en "lon".
* Laad onder het formulier de postcode.js javascript:
`<script src="/media/postcode/postcode.js"></script>`

Optioneel kun je het bijgevoegde voorbeeld formulier **postcodeform.tgz** importeren in RSFormPro 1.51.x.