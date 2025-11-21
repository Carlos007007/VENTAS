DIR='/home/angel/virtualwork/tienda'
DBUSER='admin'
DBPASS='gratis123'
DBHOST='db'
DBNAME='tienda'
APPURL='http://localhost/'
PAISCODE='151'

mkdir "$DIR"
mkdir "$DIR"/tmp/
mkdir "$DIR"/data/
mkdir "$DIR"/data/clientes/
mkdir "$DIR"/data/sessions/
mkdir "$DIR"/data/uploads/
mkdir "$DIR"/db/
mkdir "$DIR"/config/
mkdir "$DIR"/respaldos/
mkdir "$DIR"/logs/
mkdir "$DIR"/redis/
mkdir "$DIR"/rabbit/
cp my.cnf "$DIR"/config/
cp rabbit.conf "$DIR"/config/

cd "$DIR"/tmp/
git clone https://github.com/angelcantu84/puntodeventa-designlopers.git
git clone https://gitlab.com/siegroupmx/sendinbluelight.git
git clone https://gitlab.com/siegroupmx/sdk_moneybox_php.git
git clone https://gitlab.com/siegroupmx/json2xml.git
git clone https://gitlab.com/siegroupmx/xml2json.git
git clone https://gitlab.com/siegroupmx/rabbitmq.git

cp -Rf puntodeventa-designlopers/ "$DIR"/web/
mkdir "$DIR"/web/modulos/
cp -f "$DIR"/web/resources/modulos.php "$DIR"/web/modulos/modulos.php
cp -Rf sendinbluelight/ "$DIR"/web/modulos/
cp -Rf sdk_moneybox_php/ "$DIR"/web/modulos/
cp -Rf json2xml/ "$DIR"/web/modulos/
cp -Rf xml2json/ "$DIR"/web/modulos/
cp -Rf rabbitmq/ "$DIR"/web/modulos/

sed -i "s/__DB_SERVER__/$DBHOST/g" "$DIR"/web/config/server.php
sed -i "s/__DB_NAME__/$DBNAME/g" "$DIR"/web/config/server.php
sed -i "s/__DB_USER__/$DBUSER/g" "$DIR"/web/config/server.php
sed -i "s|__DB_PASS__|$DBPASS|g" "$DIR"/web/config/server.php
sed -i "s|__APPURL__|$APPURL|g" "$DIR"/web/config/app.php
sed -i "s/__PAIS_CODE__/$PAISCODE/g" "$DIR"/web/config/app.php

# unzip -d "$DIR"/web/modulos/ "$DIR"/web/modulos/phpexcel.zip
cp -f "$DIR"/web/htaccess "$DIR"/web/.htaccess

# googleauth
# cd "$DIR"/tmp/
# git clone https://github.com/sonata-project/GoogleAuthenticator
# cp -Rf GoogleAuthenticator/ "$DIR"/web/modulos/
# cd "$DIR"/web/modulos/GoogleAuthenticator/
# echo "<?php" > "$DIR"/web/modulos/GoogleAuthenticator/autoload.php
# echo "\$pathMain= dirname(__FILE__). '/';" >> "$DIR"/web/modulos/GoogleAuthenticator/autoload.php
# echo "include( \$pathMain.\"src/FixedBitNotation.php\" );" >> "$DIR"/web/modulos/GoogleAuthenticator/autoload.php
# echo "include( \$pathMain.\"src/GoogleQrUrl.php\" );" >> "$DIR"/web/modulos/GoogleAuthenticator/autoload.php
# echo "include( \$pathMain.\"src/GoogleAuthenticatorInterface.php\" );" >> "$DIR"/web/modulos/GoogleAuthenticator/autoload.php
# echo "include( \$pathMain.\"src/RuntimeException.php\" );" >> "$DIR"/web/modulos/GoogleAuthenticator/autoload.php
# echo "include( \$pathMain.\"src/GoogleAuthenticator.php\" );" >> "$DIR"/web/modulos/GoogleAuthenticator/autoload.php
# echo "?>" >> "$DIR"/web/modulos/GoogleAuthenticator/autoload.php

cd "$DIR"/web/resources/
docker-compose up -d

until docker exec db mariadb -uadmin -pgratis123 -e "SELECT 1;" tienda &>/dev/null; do
    echo "Esperando a que la base de datos arranque..."
    sleep 2
done

echo "Importando Bases de Datos..."
docker exec -i db mariadb -uadmin -pgratis123 tienda < "$DIR/web/DB/ventas.sql"
docker exec -i db mariadb -uadmin -pgratis123 tienda < "$DIR/web/DB/extras.sql"
echo "Proceso terminado..."
