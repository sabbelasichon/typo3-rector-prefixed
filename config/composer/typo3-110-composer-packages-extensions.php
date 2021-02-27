<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210227;

use Rector\Composer\Rector\ChangePackageVersionComposerRector;
use Rector\Composer\ValueObject\PackageAndVersion;
use Typo3RectorPrefix20210227\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210227\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/../services.php');
    $services = $containerConfigurator->services();
    $composerExtensions = [new \Rector\Composer\ValueObject\PackageAndVersion('andersundsehr/aus-driver-amazon-s3', '^1.3.2'), new \Rector\Composer\ValueObject\PackageAndVersion('andreaskastl/calendarize-address', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('andreaskastl/openweatherapi', '^3.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/addthis', '^1.1.2'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/aoe-dbsequenzer', '^3.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/asdis', '^2.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/captcha-viewhelper', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/dbsequenzer', '^3.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/directrequest', '^0.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/extbase-filter', '^1.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/extbase-functionals', '^0.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/extracache', '^0.9.1'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/feature-flag', '^5.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/felogin-bruteforce-protection', '^2.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/google-tag-manager', '^2.1.2'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/happy-feet', '^4.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/imgix', '^3.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/linkhandler', '^2.1.3'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/restler', '^3.1.3'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/sentry-client-js', '^0.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/staticpub', '^1.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/staticpub-pageexport', '^0.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/t3deploy-ext', '^1.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/truncate-job', '^0.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/update-refindex', '^0.2.5'), new \Rector\Composer\ValueObject\PackageAndVersion('aoe/varnish', '^0.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('aoepeople/cachemgm', '^4.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('aoepeople/crawler', '^9.2.2'), new \Rector\Composer\ValueObject\PackageAndVersion('apache-solr-for-typo3/solr', '^7.5.3'), new \Rector\Composer\ValueObject\PackageAndVersion('apache-solr-for-typo3/solrfluidexample', '^4.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('apache-solr-for-typo3/solrgrouping', '^1.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('apache-solr-for-typo3/tika', '^5.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/akamai', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/assetcollector', '^1.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/authorized-preview', '^1.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/bolt', '^2.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/distributed-locks', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/geocoding', '^4.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/graceful-cache', '^0.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/host-variants', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/http2', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/justincase', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/masi', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b13/proxycachemanager', '^3.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('b3n/azurestorage', '^0.5.2'), new \Rector\Composer\ValueObject\PackageAndVersion('beechit/backup-restore', '^3.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beechit/default-upload-folder', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cfg_page', '^9.5.4'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cfg_repository', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cfg_typoscript', '^9.5.10'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cfg_user', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_brand', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_annoying_popup', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_bs_btn', '^9.5.2'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_cards', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_contactperson', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_cssslider', '^9.5.5'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_facts', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_google_map', '^8.7.5'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_img', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_cnt_share', '^8.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_dynamiccontent', '^9.5.2'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_nav_anchor', '^9.5.9'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_nav_breadcrumb', '^9.5.2'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_cpt_nav_mobile', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_address', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_api', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_article', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_event', '^8.7.4'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_felogin_tracking', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_history', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_metadata', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_news', '^8.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_representative', '^8.7.8'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ext_taxonomy', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_googleforjobs', '^9.5.9'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_hooks', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ovr_fluidstyledcontent', '^9.5.4'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ovr_metaseo', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ovr_powermail', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ovr_realurl', '^8.7.6'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ovr_sourceopt', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_ovr_sys_language', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_backendlayout', '^9.5.4'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_blazy', '^9.5.5'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_bs', '^9.5.2'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_custom', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_error', '^9.5.2'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_jq', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_jq_hammer', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_modernizr', '^8.7.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_pace', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_thm_webfontloader', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_userfuncs', '^9.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('beewilly/hive_viewhelpers', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('bgm/bgm-hreflang', '^2.0.7'), new \Rector\Composer\ValueObject\PackageAndVersion('bitmotion/auth0', '^3.4.1'), new \Rector\Composer\ValueObject\PackageAndVersion('bitmotion/locate', '^11.0.0-beta1'), new \Rector\Composer\ValueObject\PackageAndVersion('bj/bj-polaroyd', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('bmack/modern-template-building', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/codehighlight', '^2.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/coordconverter', '^3.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/extpagetitle', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/form-country-select', '^1.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/schema', '^1.10.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/schema-virtuallocation', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/sdbreadcrumb', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/typo3-jobrouter-rss-widgets', '^1.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/typo3-matomo-optout', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('brotkrueml/typo3-matomo-widgets', '^0.3.2'), new \Rector\Composer\ValueObject\PackageAndVersion('c1/c1-adaptive-images', '^0.3.1'), new \Rector\Composer\ValueObject\PackageAndVersion('cabag/ext-http2-push', '^0.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('cabag/simulatebe', '^3.0.4'), new \Rector\Composer\ValueObject\PackageAndVersion('causal/extractor', '^2.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('causal/fal-protect', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('causal/image_autoresize', '^2.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('causal/restdoc', '^2.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('cedricziel/transladder', '^0.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('chf/backend-module', '^0.9.1'), new \Rector\Composer\ValueObject\PackageAndVersion('chf/teaser-manager', '^1.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('christophlehmann/httpbasicauth', '^1.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('clickstorm/cs_seo', '^2.3.2'), new \Rector\Composer\ValueObject\PackageAndVersion('cmsexperts/bolt', '^2.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('co-stack/fal_sftp', '^2.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('commerceteam/commerce', '^5.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('cpsit/t3events_course', '^0.11.0'), new \Rector\Composer\ValueObject\PackageAndVersion('cpsit/t3events_reservation', '^0.16.0'), new \Rector\Composer\ValueObject\PackageAndVersion('daniel-pfeil/samlauthentication', '^2.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('danielgoerz/fs-code-snippet', '^1.9.0'), new \Rector\Composer\ValueObject\PackageAndVersion('digicademy/beaconizer', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('digicademy/chf_geo', '^0.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('digicademy/chf_time', '^0.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('digicademy/cobj_xpath', '^1.10.0'), new \Rector\Composer\ValueObject\PackageAndVersion('digicademy/cobj_xslt', '^1.10.0'), new \Rector\Composer\ValueObject\PackageAndVersion('dkd/hostedsolr', '^0.4.1'), new \Rector\Composer\ValueObject\PackageAndVersion('dmind/cookieman', '^2.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('dmk/mkpostman', '^1.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('dwenzel/reporter', '^0.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('dwenzel/t3events', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('dwenzel/t3extension-tools', '^1.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('evoweb/ew-llxml2xliff', '^2.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('evoweb/ew-socialfeedwall', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('evoweb/extender', '^6.4.7'), new \Rector\Composer\ValueObject\PackageAndVersion('evoweb/recaptcha', '^8.2.7'), new \Rector\Composer\ValueObject\PackageAndVersion('evoweb/sf-books', '^4.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('evoweb/store-finder', '^1.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('extrameile/em_tvplus_theme_demo', '^0.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('fidelo/typo3', '^4.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('fixpunkt/fp-fractionslider', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('fluidtypo3/site', '^1.6.0'), new \Rector\Composer\ValueObject\PackageAndVersion('friendsofcrawler/typo3-crawler-widget', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('friendsoftypo3/compatibility6', '^7.6.5'), new \Rector\Composer\ValueObject\PackageAndVersion('friendsoftypo3/compatibility7', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('friendsoftypo3/legacy-collections', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('friendsoftypo3/openid', '^11.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('friendsoftypo3/rtehtmlarea', '^8.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('friendsoftypo3/tt-address', '^3.2.4'), new \Rector\Composer\ValueObject\PackageAndVersion('georgringer/doc', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('georgringer/numbered-pagination', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('georgringer/page_speed', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('hmmh/solr-file-indexer', '^2.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cfg_page', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cfg_repository', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cfg_typoscript', '^8.9.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cfg_user', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_brand', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_cnt_annoying_popup', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_cnt_bs_btn', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_cnt_cssslider', '^8.8.3'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_cnt_google_map', '^8.7.6'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_cnt_img', '^8.8.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_cnt_share', '^8.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_dynamiccontent', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_nav_anchor', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_cpt_nav_mobile', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_address', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_api', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_article', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_event', '^8.7.5'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_felogin_tracking', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_metadata', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_representative', '^8.7.6'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ext_taxonomy', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_hooks', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ovr_fluidstyledcontent', '^8.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ovr_metaseo', '^8.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ovr_powermail', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ovr_realurl', '^8.8.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ovr_sourceopt', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_ovr_sys_language', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_backendlayout', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_blazy', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_bs', '^8.8.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_custom', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_error', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_jq', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_jq_hammer', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_modernizr', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_pace', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_thm_webfontloader', '^8.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_userfuncs', '^8.7.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hon3y/hive_viewhelpers', '^8.8.2'), new \Rector\Composer\ValueObject\PackageAndVersion('hov/mask-permissions', '^2.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('ideative/t3-tarteaucitron', '^1.0.5'), new \Rector\Composer\ValueObject\PackageAndVersion('ifabrik/ifab-realestate', '^2.0.5'), new \Rector\Composer\ValueObject\PackageAndVersion('jokumer/xfilelist', '^2.1.3'), new \Rector\Composer\ValueObject\PackageAndVersion('josefglatz/ods-redirects', '^1.3.4'), new \Rector\Composer\ValueObject\PackageAndVersion('jweiland/avalex', '^6.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('kaesetoast/static-info-tables-zh', '^6.2.4'), new \Rector\Composer\ValueObject\PackageAndVersion('kaystrobach/dyncss', '^0.9.0'), new \Rector\Composer\ValueObject\PackageAndVersion('kitzberger/40x-handler', '^1.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('kitzberger/form-mailtext', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('kitzberger/fox-handler', '^1.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('kitzberger/indexed-search-autocomplete', '^1.0.8'), new \Rector\Composer\ValueObject\PackageAndVersion('kitzberger/rte-ckeditor-automails', '^1.0.6'), new \Rector\Composer\ValueObject\PackageAndVersion('kitzberger/rte-ckeditor-dl', '^1.0.5'), new \Rector\Composer\ValueObject\PackageAndVersion('kitzberger/workspaces-boost', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('koehnlein/koe-clearindex', '^0.0.8'), new \Rector\Composer\ValueObject\PackageAndVersion('koninklijke-collective/koning-bootstrap-carousel', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('koninklijke-collective/koning-library', '^2.1.5'), new \Rector\Composer\ValueObject\PackageAndVersion('koninklijke-collective/koning-open-graph', '^1.2.5'), new \Rector\Composer\ValueObject\PackageAndVersion('leuchtfeuer/auth0', '^3.4.1'), new \Rector\Composer\ValueObject\PackageAndVersion('leuchtfeuer/locate', '^11.0.0-beta1'), new \Rector\Composer\ValueObject\PackageAndVersion('lightwerk/vectormap', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('lochmueller/fal-dummy', '^0.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('lochmueller/static-info-tables-zh', '^6.2.4'), new \Rector\Composer\ValueObject\PackageAndVersion('lolli/enetcache', '^4.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('lst/backend-module', '^0.9.1'), new \Rector\Composer\ValueObject\PackageAndVersion('lst/teaser-manager', '^1.7.1'), new \Rector\Composer\ValueObject\PackageAndVersion('maxserv/parsedown', '^1.0.4'), new \Rector\Composer\ValueObject\PackageAndVersion('mbhsoft/solr-bs-date-range-facet', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('mbhsoft/solr-fluid-indexer', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('medienreaktor/form_double_opt_in', '^1.1.2'), new \Rector\Composer\ValueObject\PackageAndVersion('medienreaktor/form_doubleoptin', '^1.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('merzilla/inm-googlesitemap', '^0.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('meteko/autosite', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('mfc/mfc-belogin-captcha', '^5.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('mia3/mia3-search', '^4.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('mittwald/typo3_forum', '^1.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('neoblack/extended-sys-news', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/nitsan-hellobar', '^4.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/nitsan-maintenance', '^4.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-all-chat', '^2.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-all-lightbox', '^4.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-all-sliders', '^5.3.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-backup', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-basetheme', '^10.4.4'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-comments', '^1.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-cookiebot', '^1.1.2'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-cookies', '^1.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-disqus-comments', '^1.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-facebook-comment', '^1.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-faq', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-feedback', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-gallery', '^1.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-google-map', '^2.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-googledocs', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-guestbook', '^2.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-instagram', '^2.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-lazy-load', '^1.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-news-advancedsearch', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-news-comments', '^4.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-news-slider', '^3.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-protect-site', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-revolution-slider', '^1.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-sharethis', '^2.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-snow', '^1.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-statcounter', '^2.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-theme-agency', '^2.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-theme-child', '^9.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-theme-cleanblog', '^2.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-theme-comingsoon', '^2.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-theme-extend', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-theme-freelancer', '^2.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-theme-newage', '^2.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-twitter', '^2.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-youtube', '^1.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns-zoho-crm', '^2.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('nitsan/ns_ext_compatibility', '^5.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('onedrop/solr-extbase', '^0.0.2'), new \Rector\Composer\ValueObject\PackageAndVersion('opsone-ch/varnish', '^2.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('pallino/webpack', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('patrickbroens/url-forwarding', '^1.3.1'), new \Rector\Composer\ValueObject\PackageAndVersion('phijufa/template', '^9.0.6'), new \Rector\Composer\ValueObject\PackageAndVersion('phorax/loginas', '^3.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('pixelant/pxa-siteimprove', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('plan2net/fake-fal', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('plan2net/webp', '^0.9.1'), new \Rector\Composer\ValueObject\PackageAndVersion('pluswerk/comments', '^1.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('pluswerk/html_to_pdf', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('pluswerk/mail-logger', '^1.2.13'), new \Rector\Composer\ValueObject\PackageAndVersion('pluswerk/mediacenter', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('pluswerk/minify', '^1.0.7'), new \Rector\Composer\ValueObject\PackageAndVersion('pluswerk/timeline', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('quizpalme/camaliga', '^8.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('rgu/bootstrap_package-dvoconnector', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('rgu/dvoconnector', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('rgu/metaseo-dvoconnector', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('rgu/metaseo-vhs', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('rupertgermann/tt_news', '^9.5.1'), new \Rector\Composer\ValueObject\PackageAndVersion('sbtheke/backgroundimage', '^4.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sbtheke/cewrap', '^4.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sbtheke/cookies', '^5.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('schnitzler/fluid-styled-responsive-images', '^11.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sebkln/content-slug', '^1.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('serfhos/my-search-crawler', '^0.4.1'), new \Rector\Composer\ValueObject\PackageAndVersion('sethorax/typo3-dcp', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sethorax/typo3-directcontent', '^0.1.3'), new \Rector\Composer\ValueObject\PackageAndVersion('sethorax/typo3-fluidloader', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/content-replacer', '^3.1.2'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/df-contentslide', '^6.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/df-tabs', '^5.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/df-tools', '^2.0.4'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/lfeditor', '^3.3.3'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/scriptmerger', '^5.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/sg-cloud-front', '^1.1.2'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/sg-contentlink', '^1.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/tinymce', '^4.4.1'), new \Rector\Composer\ValueObject\PackageAndVersion('sgalinski/tinymce4-rte', '^2.2.2'), new \Rector\Composer\ValueObject\PackageAndVersion('simonkoehler/ce-timeline', '^3.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('sitegeist/csv-labels', '^1.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('sitegeist/fluid-components', '^2.5.0'), new \Rector\Composer\ValueObject\PackageAndVersion('sitegeist/fluid-styleguide', '^1.9.1'), new \Rector\Composer\ValueObject\PackageAndVersion('snowflakeops/varnish', '^2.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('sourcebroker/restrictfe', '^4.1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('ssch/typo3-encore', '^3.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('steinbauerit/sit-googlereviews', '^1.1'), new \Rector\Composer\ValueObject\PackageAndVersion('styladev/typo3', '^1.0.6'), new \Rector\Composer\ValueObject\PackageAndVersion('supseven/supi', '^3.1.3'), new \Rector\Composer\ValueObject\PackageAndVersion('susanne/hcaptcha', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('svenjuergens/belogin_images', '^3.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('svenjuergens/minicleaner', '^2.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('svenjuergens/rte-ckeditor-iframe', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('svenjuergens/weather-widget', '^1.1.0'), new \Rector\Composer\ValueObject\PackageAndVersion('svewap/ws-scss', '^1.1.19'), new \Rector\Composer\ValueObject\PackageAndVersion('svewap/ws-slider', '^0.9.5'), new \Rector\Composer\ValueObject\PackageAndVersion('t3docs/examples', '^11.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('t3docs/store-inventory', '^11.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('t3monitor/t3monitoring', '^0.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('templavoilaplus/templavoilaplus', '^8.0.0-alpha.6'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3-themes/themes', '^9.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('undefined/translate-locallang', '^2.7.3'), new \Rector\Composer\ValueObject\PackageAndVersion('vertexvaar/falsftp', '^2.2.0'), new \Rector\Composer\ValueObject\PackageAndVersion('vierwd/typo3-smarty', '^2.2.1'), new \Rector\Composer\ValueObject\PackageAndVersion('visol/viresponsiveimages', '^0.9.15'), new \Rector\Composer\ValueObject\PackageAndVersion('visuellverstehen/t3visuellverstehen', '^1.0.10'), new \Rector\Composer\ValueObject\PackageAndVersion('wapplersystems/templatemaker', '^1.2.2'), new \Rector\Composer\ValueObject\PackageAndVersion('wazum/sluggi', '^1.0.0'), new \Rector\Composer\ValueObject\PackageAndVersion('wdb/typo3-forum', '^1.0.3'), new \Rector\Composer\ValueObject\PackageAndVersion('web-tp3/cag_tests', '^2.0.1'), new \Rector\Composer\ValueObject\PackageAndVersion('web-tp3/wec_map', '^4.1.5')];
    $services->set('change_composer_json_for_extensions')->class(\Rector\Composer\Rector\ChangePackageVersionComposerRector::class)->call('configure', [[\Rector\Composer\Rector\ChangePackageVersionComposerRector::PACKAGES_AND_VERSIONS => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline($composerExtensions)]]);
};
