
plugin.tx_visittablets_glossarfe {
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Templates/
    templateRootPaths.1 = plugin.tx_visittablets_glossarfe.view.templateRootPath
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Partials/
    partialRootPaths.1 = plugin.tx_visittablets_glossarfe.view.partialRootPath
    layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Layouts/
    layoutRootPaths.1 = plugin.tx_visittablets_glossarfe.view.layoutRootPath
  }
  persistence {
    storagePid = plugin.tx_visittablets_glossarfe.persistence.storagePid
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_visittablets_galeriefe {
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Templates/
    templateRootPaths.1 = plugin.tx_visittablets_galeriefe.view.templateRootPath
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Partials/
    partialRootPaths.1 = plugin.tx_visittablets_galeriefe.view.partialRootPath
    layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Layouts/
    layoutRootPaths.1 = plugin.tx_visittablets_galeriefe.view.layoutRootPath
  }
  persistence {
    storagePid = plugin.tx_visittablets_galeriefe.persistence.storagePid
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_visittablets_kartefe {
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Templates/
    templateRootPaths.1 = plugin.tx_visittablets_kartefe.view.templateRootPath
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Partials/
    partialRootPaths.1 = plugin.tx_visittablets_kartefe.view.partialRootPath
    layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Layouts/
    layoutRootPaths.1 = plugin.tx_visittablets_kartefe.view.layoutRootPath
  }
  persistence {
    storagePid = plugin.tx_visittablets_kartefe.persistence.storagePid
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_visittablets._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-visit-tablets table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-visit-tablets table th {
        font-weight:bold;
    }

    .tx-visit-tablets table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

# Module configuration
module.tx_visittablets_web_visittabletsglossar {
  persistence {
    storagePid = module.tx_visittablets_glossar.persistence.storagePid
  }
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Templates/
    templateRootPaths.1 = module.tx_visittablets_glossar.view.templateRootPath
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Partials/
    partialRootPaths.1 = module.tx_visittablets_glossar.view.partialRootPath
    layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Layouts/
    layoutRootPaths.1 = module.tx_visittablets_glossar.view.layoutRootPath
  }
}

# Module configuration
module.tx_visittablets_web_visittabletsgalerie {
  persistence {
    storagePid = module.tx_visittablets_galerie.persistence.storagePid
  }
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Templates/
    templateRootPaths.1 = module.tx_visittablets_galerie.view.templateRootPath
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Partials/
    partialRootPaths.1 = module.tx_visittablets_galerie.view.partialRootPath
    layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Layouts/
    layoutRootPaths.1 = module.tx_visittablets_galerie.view.layoutRootPath
  }
}

# Module configuration
module.tx_visittablets_web_visittabletskarte {
  persistence {
    storagePid = module.tx_visittablets_karte.persistence.storagePid
  }
  view {
    templateRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Templates/
    templateRootPaths.1 = module.tx_visittablets_karte.view.templateRootPath
    partialRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Partials/
    partialRootPaths.1 = module.tx_visittablets_karte.view.partialRootPath
    layoutRootPaths.0 = EXT:visit_tablets/Resources/Private/Backend/Layouts/
    layoutRootPaths.1 = module.tx_visittablets_karte.view.layoutRootPath
  }
}
