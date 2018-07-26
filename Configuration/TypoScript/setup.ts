
plugin.tx_visittablets {
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Plugin/Templates/
    templateRootPaths.1 = {$plugin.tx_visittablets.view.templateRootPath}
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Plugin/Partials/
    partialRootPaths.1 = {$plugin.tx_visittablets.view.partialRootPath}
    layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Plugin/Layouts/
    layoutRootPaths.1 = {$plugin.tx_visittablets.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_visittablets.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}
plugin.tx_visittablets_glossarfe  <. plugin.tx_visittablets
plugin.tx_visittablets_galeriefe <. plugin.tx_visittablets
plugin.tx_visittablets_kartefe <. plugin.tx_visittablets



##############
#### PAGE ####
##############
page = PAGE
page {
    typeNum = 0
#    shortcutIcon = {$page.favicon.file}

#    bodyTagCObject = COA
#    bodyTagCObject {
#        10 = TEXT
#        10.data = TSFE:id
#        10.noTrimWrap = | id="p|"|
#        20 =< lib.page.class
#        20.stdWrap.noTrimWrap = | class="|"|
#        wrap = <body|>
#    }

    10 = FLUIDTEMPLATE
    10 {
        # Template names will be generated automaticly by converting the applied
        # backend_layout, there is no explicit mapping nessesary anymore.
        #
        # BackendLayout Key
        # subnavigation_right_2_columns -> SubnavigationRight2Columns.html
        #
        # Backend Record
        # uid: 1 -> 1.html
        #
        # Database Entry
        # value: -1 -> None.html
        # value: pagets__subnavigation_right_2_columns -> SubnavigationRight2Columns.html
        templateName = TEXT
        templateName {
            cObject = TEXT
            cObject {
                data = pagelayout
                required = 1
                case = uppercamelcase
                split {
                    token = pagets__
                    cObjNum = 1
                    1.current = 1
                }
            }
            ifEmpty = Default
        }

        templateRootPaths {
            0 = EXT:visit_tablets/Resources/Private/Page/Templates/
        }
        partialRootPaths {
            0 = EXT:visit_tablets/Resources/Private/Page/Partials/
        }
        layoutRootPaths {
            0 = EXT:visit_tablets/Resources/Private/Page/Layouts/
        }
    }

    meta {

        viewport = {$page.meta.viewport}
        robots = {$page.meta.robots}
        apple-mobile-web-app-capable = {$page.meta.apple-mobile-web-app-capable}

        X-UA-Compatible = {$page.meta.compatible}
        X-UA-Compatible {
            attribute = http-equiv
        }

    }

    includeCSS {

#        bobfont = EXT:bootstrap_package/Resources/Public/Css/specialIconFont.css
#      
#        #dark / light + bottom / top + css
#        #moved from plugin to here for concatination
#        mindshape_cookie_hint = EXT:mindshape_cookie_hint/Resources/Public/Css/dark-bottom.css
#        alertify = EXT:bootstrap_package/Resources/Public/Css/alertify.css
#        lightbox = EXT:bootstrap_package/Resources/Public/Css/lightbox.min.css
#
#        theme = EXT:bootstrap_package/Resources/Public/Css/main.css
    }


    includeJSFooterlibs {

        #SRI Hash Generator https://www.srihash.org/

#        jquery = https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js
#        jquery.external = 1
#        jquery.integrity = 1
#        jquery.forceOnTop = 1
#        jquery.integrity = sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT
#        jquery.excludeFromConcatenation = 1
#        jquery.disableCompression = 1
#
#        popper = https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js
#        popper.external = 1
#        popper.integrity = sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ
#        popper.excludeFromConcatenation = 1
#        popper.disableCompression = 1
#
#        bootstrap = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/bootstrap.min.js
#
#        #bootstrap.external = 1
#        #bootstrap.integrity = sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm
#        #bootstrap.excludeFromConcatenation = 1
#        #bootstrap.disableCompression = 1
#
#        responsiveimages = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/jquery.responsiveimages.min.js
#        alertify = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/alertify.js
#        lightbox = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/lightbox.min.js
#        isodope = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/isotope.pkgd.min.js
      
    }
}
