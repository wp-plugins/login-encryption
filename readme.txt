=== Login Encrypt ===
Contributors: elserver
Donate link: http://www.elserver.com/
Tags: login, encryption
Requires at least: 2.0
Tested up to: 2.0
Stable tag: 1.0

An encryption plugin that ciphers the password using RSA and DES, securing login without SSL.

== Description ==

Login Encrypt is a security plugin. It uses a complex combination of DES and RSA.
It was first developed by ELSERVER for securing login in the hosting control panel, and then released as a WordPress plugin.

The way it works (fast explanation):
*	A Javascript appended to the wp-login generates, each time a user logs in, a unique DES key. Using that key, the password of the user is encrypted.
*	The Javascript encrypts the DES unique key using the RSA public key (generated when the plugin is activated).
*	The encripted password and the encrypted DES unique key are sended to the server.
*	A hook when login in checks if a encrypted DES unique key is received. If does, decrypts it using the secure RSA private key.
*	Then, decrypts the password using the DES unique key.

== Note == 

Login Encrypt required php5 at least. 

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `login-encrypt` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. You're done!