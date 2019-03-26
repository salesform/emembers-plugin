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
