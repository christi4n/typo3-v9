<?php
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = getenv('TYPO3_SYS_SITE_NAME');
$GLOBALS['TYPO3_CONF_VARS']['DB']['installToolPassword'] = getenv('TYPO3_INSTALL_TOOL_PASSWORD');

# Database
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = getenv('TYPO3_DB_DBNAME');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = getenv('TYPO3_DB_USER');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = getenv('TYPO3_DB_PASSWORD');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = getenv('TYPO3_DB_HOST');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['port'] = getenv('TYPO3_DB_PORT');

# Encryption
$GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] = getenv('TYPO3_SYS_ENCRYPTION_KEY');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = getenv('TYPO3_SYS_TRUSTED_HOSTS_PATTERN');

# Mail settings
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = getenv('TYPO3_MAIL_TRANSPORT');
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_encrypt'] = getenv('TYPO3_MAIL_TRANSPORT_SMTP_ENCRYPT');
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_password'] = getenv('TYPO3_MAIL_TRANSPORT_SMTP_PASSWORD');
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_server'] = getenv('TYPO3_MAIL_TRANSPORT_SMTP_SERVER');
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_username'] = getenv('TYPO3_MAIL_TRANSPORT_SMTP_USERNAME');
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] = getenv('TYPO3_MAIL_DEFAULT_FROM');

$appContext = (string)\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext();
switch ($appContext) {

    case 'Development':
    case 'Development/Integration':
        $disabledCaches = ['l10n', 'cache_core'];
        foreach ($disabledCaches as $disabledCache) {
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$disabledCache]['backend'] =
                \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
        }
        $GLOBALS['TYPO3_CONF_VARS']['BE']['lockIP'] = 1;
        $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = 0;

        break;

    case 'Production/Validation':
    case 'Production':
        break;
}
