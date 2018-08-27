
plugin.tx_visittablets {
  view {
    # cat=plugin.tx_visittablets_glossarfe/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:visit_tablets/Resources/Private/Plugin/Templates/
    # cat=plugin.tx_visittablets_glossarfe/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:visit_tablets/Resources/Private/Plugin/Partials/
    # cat=plugin.tx_visittablets_glossarfe/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:visit_tablets/Resources/Private/Plugin/Layouts/
  }
  persistence {
    # cat=plugin.tx_visittablets_glossarfe//a; type=string; label=Default storage PID
    storagePid =
  }
}
