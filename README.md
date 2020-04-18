# emembers-plugin
SalesForm összekötés a népszerű Emember WP pluginnel, így előfizetéses rendszer alakítható ki.

Az alábbiak szerint működik.

- Ha sikeres volt a fizetés megnézi létezik-e már a felhasználó.

     - Ha igen akkor ellenőrzi aktív-e az előfizetés.

         - Ha nem akkor aktiválja.

     - Egy szinttel feljebb lépteti ha még nem érte el a maximumot.

     - Ha nem létezik a felhasználó létrehozza a kezdő szinttel.

- Ha sikertelen volt a fizetés letiltja a felhasználót


Ha változnak a level ID-ék akkor már nem működik, át 
kell írni.

# Ami szükséges hozzá:

- SalesForm.hu előfizetés: www.salesform.hu
- Emembers wordpress plugin: https://www.tipsandtricks-hq.com/wordpress-emember-easy-to-use-wordpress-membership-plugin-1706
- ismétlődő fizetés:
  - OTP SIMPLE: http://www.rendelesiurlap.hu/cikk/otp-simple-online-bankkartyas-fizeteshez-online-szerzodeskotes-lepesei
  - CIB bank: http://www.rendelesiurlap.hu/cikk/cib-online-bankkartya-fizeteshez-a-szerzodes-menete
  
# Hozzáféré kiküldése automatikusan  

- A rendeléskor megadott e-mail cím lesz a felhasználónév
- A rendelés azonosítója (trid) lesz a jelszó.

Ezeket az adatokat átadjuk minden hírlevélküldőnek is, így a rendelés leadásakor egyből tudsz is küldeni neki egy levelet, amiben benne vannak az adatok.


# Telepítés:

- a fájl letöltöd és felteszed a tárhelyed fő mappájába
- megnyitod szerkesztésre és megadod
     - A domain nevet, ahova telepítetted az ememberst
     - Az ememberstől kapott api kulcsot
- A SalesForm admin felületén beállítod a ismétlődő fizetéses csomaghoz a webhooknak ennek a fájlnak az elérhetőségét. Vagyis ha a www.facebookreklam.hu domainen fut a klubtagság, akkor ezt: www.facebookreklam.hu/webhook_emember-os.php

# Így teszteld:

- Csinálj egy 1 napos ismétlődő fizetést
- állítsd tesztre a terméket
- Adj le egy teszt rendelést
- be kell kerülnie a rendszerbe
- majd a következő vonásnál másnap, emelkednie kell a jogosultság szintnek

# Support:

hello-kukac-salesform.hu
