<?php
use vendor\autoload;


\Paydunya\Setup::setMasterKey("wQzk9ZwR-Qq9m-0hD0-zpud-je5coGC3FHKW");
\Paydunya\Setup::setPublicKey("test_public_kb9Wo0Qpn8vNWMvMZOwwpvuTUja");
\Paydunya\Setup::setPrivateKey("test_private_rMIdJM3PLLhLjyArx9tF3VURAF5");
\Paydunya\Setup::setToken("IivOiOxGJuWhc5znlIiK");
\Paydunya\Setup::setMode("test"); // Optionnel. Utilisez cette option pour les paiements tests.

//Configuration des informations de votre service/entreprise
\Paydunya\Checkout\Store::setName("Magasin Chez Sandra"); // Seul le nom est requis
\Paydunya\Checkout\Store::setTagline("L'élégance n'a pas de prix");
\Paydunya\Checkout\Store::setPhoneNumber("336530583");
\Paydunya\Checkout\Store::setPostalAddress("Dakar Plateau - Etablissement kheweul");
\Paydunya\Checkout\Store::setWebsiteUrl("http://www.chez-sandra.sn");
\Paydunya\Checkout\Store::setLogoUrl("http://www.chez-sandra.sn/logo.png");


\Paydunya\Checkout\Store::setCallbackUrl("http://magasin-le-choco.com/callback_url.php");