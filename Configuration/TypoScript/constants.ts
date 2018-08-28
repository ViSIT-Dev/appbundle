## Define custom categories
# customsubcategory=system=System
# customsubcategory=app=Applikation

plugin.tx_visittablets {
  view {
    # cat=plugin.tx_visittablets/system/0010; type=string; label=Path to template root (FE)
    templateRootPath = EXT:visit_tablets/Resources/Private/Plugin/Templates/
    # cat=plugin.tx_visittablets/system/0010; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:visit_tablets/Resources/Private/Plugin/Partials/
    # cat=plugin.tx_visittablets/system/0010; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:visit_tablets/Resources/Private/Plugin/Layouts/
  }
  persistence {
    # cat=plugin.tx_visittablets/system/0000; type=string; label=Default storage PID
    storagePid =
  }

  application{
         # cat=plugin.tx_visittablets/app/0000; type=string; label=API Schlüssel für Google Maps
        googleMapsApiKey =
  }

}
