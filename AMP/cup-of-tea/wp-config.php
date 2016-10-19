<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '28TI95(J6B!ia8m[WngPkvJGMGIc,4`2S<y}_m]Nf:U?5U&=$x,|;XWEOD+XFRet');
define('SECURE_AUTH_KEY',  'ZlR_=?WfMoWGb_}(]-T*2.OL(|DnL9^]<&~l[Il{,)1;g lhl,3$4F6)[ev_]x4-');
define('LOGGED_IN_KEY',    'RsL&5=po2h)as$?uN}!O1u}Y7R9(:ZODV7[|@rn:.2(NOy^`@:x,/9]%_4>Uxl1|');
define('NONCE_KEY',        ']*m3w 2h;L5ZX(-|#~1rK,mB/_i{PL#y4[i^t_ICjUcuvhVl=Bc;yS*j0L+j<6J5');
define('AUTH_SALT',        'bM2kDHTotRt#/vOU*8~IT!C_%qpf i%1{Y{N,5QL%)}>&okwBUn9`Il)xpJC|k]?');
define('SECURE_AUTH_SALT', 'se@FT*67{f/L~[nGx]V%4VJcond!4fad67WQcGI@#*O2B}R3@xX@pFf5Cw1kyaWY');
define('LOGGED_IN_SALT',   '8[U`EJ|xFBbQ>XEP8H9T=Am>58Sj=Ol4qW}*4YuL^mdg#fl7d&6Qrx`eh{<}?7P2');
define('NONCE_SALT',       'mk}E]%#*#+[z4@(6&As$E)cVHKy5`6$W.2t%Lk!Ngy<#Z(exB#}|gzF_a=0;>vx;');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp2_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');