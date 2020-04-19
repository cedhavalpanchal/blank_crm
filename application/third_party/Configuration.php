<?php

class Configuration {

    // For a full list of configuration parameters refer in wiki page (https://github.com/paypal/sdk-core-php/wiki/Configuring-the-SDK)
    public static function getConfig() {
        $config = array(
            // values: 'sandbox' for testing
            //		   'live' for production
            "mode" => "sandbox"

                // These values are defaulted in SDK. If you want to override default values, uncomment it and add your value.
                // "http.ConnectionTimeOut" => "5000",
                // "http.Retry" => "2",
        );
        return $config;
    }

    // Creates a configuration array containing credentials and other required configuration parameters.
    public static function getAcctAndConfig() {
        $config = array(
            // Signature Credential
            "acct1.UserName" => "megha_api1.topsinfosolutions.com",
            "acct1.Password" => "5S7ZT9NSBD3QFC55",
            "acct1.Signature" => "AI7lmouzGlbcBNpG8d1al0v0CAvnAgvTn96lwVeMLJHs2oWHfqoFtvtf",
            "acct1.AppId" => "APP-80W284485P519543T" //Same For All Sandbox

                // Sample Certificate Credential
                // "acct1.UserName" => "certuser_biz_api1.paypal.com",
                // "acct1.Password" => "D6JNKKULHN3G5B8A",
                // Certificate path relative to config folder or absolute path in file system
                // "acct1.CertPath" => "cert_key.pem",
                // "acct1.AppId" => "APP-80W284485P519543T"
        );

        return array_merge($config, self::getConfig());
        ;
    }

}
