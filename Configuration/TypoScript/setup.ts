################################################
#### DYNAMIC CONTENT LIB FOR USAGE IN FLUID ####
################################################
#
#  EXAMPLE
#  ---------------
#  <f:cObject typoscriptObjectPath="lib.dynamicContent" data="{pageUid: '{data.uid}', colPos: '0', wrap: '<div class=\"hero\">|</div>', elementWrap: '<div class=\"element\">|</div>'}" />
#
#
#  COLUMN NUMBERS
#  ---------------
#
#  0  = main
#  1  = left
#  2  = right
#
#################
lib.dynamicContent = COA
lib.dynamicContent {
    5 = LOAD_REGISTER
    5 {
        colPos.cObject = TEXT
        colPos.cObject {
            field = colPos
            ifEmpty.cObject = TEXT
            ifEmpty.cObject {
                value.current = 1
                ifEmpty = 0
            }
        }
        pageUid.cObject = TEXT
        pageUid.cObject {
            field = pageUid
            ifEmpty.data = TSFE:id
        }
        contentFromPid.cObject = TEXT
        contentFromPid.cObject {
            data = DB:pages:{register:pageUid}:content_from_pid
            data.insertData = 1
        }
        wrap.cObject = TEXT
        wrap.cObject {
            field = wrap
        }
        elementWrap.cObject = TEXT
        elementWrap.cObject{
            field = elementWrap
        }
    }
    20 = CONTENT
    20 {
        table = tt_content
        select {
            includeRecordsWithoutDefaultTranslation = 1
            orderBy = sorting
            where = {#colPos}={register:colPos}
            where.insertData = 1
            pidInList.data = register:pageUid
            pidInList.override.data = register:contentFromPid
        }
        renderObj{
            stdWrap{
                dataWrap = {register:elementWrap}
                required = 1
            }
        }
        stdWrap {
            dataWrap = {register:wrap}
            required = 1
        }
    }
    90 = RESTORE_REGISTER
}
lib.dynamicContentSlide =< lib.dynamicContent
lib.dynamicContentSlide.20.slide = -1




plugin.tx_visittablets {
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Plugin/Templates/
    templateRootPaths.1 = {$plugin.tx_visittablets.view.templateRootPath}
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Plugin/Partials/
    partialRootPaths.1 = {$plugin.tx_visittablets.view.partialRootPath}
    partialRootPaths.2 = EXT:visit_tablets/Resources/Private/SharedPartials/
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
plugin.tx_visittablets_fernrohrfe <. plugin.tx_visittablets


# Module configuration
module.tx_visittablets {
    settings{
       backendPath = /typo3conf/ext/visit_tablets/Resources/Public/Backend/
       uploadDir = {$plugin.tx_visittablets.application.uploadDir}
    }
    persistence {
        storagePid = {$plugin.tx_visittablets.persistence.storagePid}
    }
    view {
        templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Templates/
        partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Partials/
        partialRootPaths.1 = EXT:visit_tablets/Resources/Private/SharedPartials/
        layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Layouts/
    }
}

# Module glossar configuration
module.tx_visittablets_visit_visittabletsglossarbe <. module.tx_visittablets

# Module karte configuration
module.tx_visittablets_visit_visittabletskartebe <. module.tx_visittablets 

# Module fernrohr configuration
module.tx_visittablets_visit_visitfernrohr <. module.tx_visittablets 


config {
    no_cache = 1

    # Localization:
    #default-Konfiguration
    sys_language_uid = 0
    language = de
    locale_all = de_DE
    htmlTag_langKey = de

    [globalVar = GP:L = 0]
    # Configuration if &L=0
    sys_language_uid = 0
    language = de
    locale_all = de_DE
    htmlTag_langKey = de
    [global]

    [globalVar = GP:L = 1]
    # Configuration if &L=1
    sys_language_uid = 1
    language = en
    locale_all = en_EN
    htmlTag_langKey = en
    [global]

}

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

        viewport = width=device-width, initial-scale=1, maximum-scale=1    
        apple-mobile-web-app-capable = yes

        X-UA-Compatible = http-equiv


    }

    includeCSS {

#        font-awesome = EXT:visit_tablets/Resources/Public/vendor/font-awesome/css/all.css
        material-design = EXT:visit_tablets/Resources/Public/vendor/material-design/css/materialdesignicons.css
        leaflet = EXT:visit_tablets/Resources/Public/Backend/vendors/leaflet/leaflet.css
        main = EXT:visit_tablets/Resources/Public/css/main.css

    }

    includeJSFooter {
        app = EXT:visit_tablets/Resources/Public/js/app.js
    }

    includeJSFooterlibs {

        jquery = EXT:visit_tablets/Resources/Public/vendor/jquery/jquery-3.3.1.min.js

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
#        alertify = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/alertify.js
#        lightbox = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/lightbox.min.js
#        isodope = EXT:bootstrap_package/Resources/Public/JavaScript/Dist/isotope.pkgd.min.js
      
    }
}
