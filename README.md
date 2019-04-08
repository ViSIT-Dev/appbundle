# Visit Apps
Typo3 Extension that contains all applications

## Beispiel Startsseite für Tablets
    <div class="modal-content">
        <div class="modal-body">
            <h1 class="modal-title">Lorem ipsum dolor Headline</h1>
            <h3>Lorem ipsum dolor Subline historisch</h3>
            <br>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget elit a lacus sollicitudin finibus. Donec sed arcu mauris. Quisque eget fringilla erat. Cras sit amet sagittis nulla. In quis euismod tellus. Nulla pharetra elit risus, at mattis urna dignissim sit amet. Nunc luctus vestibulum mauris, vel tempor lorem luctus vitae.
                <br><br>
                Vivamus placerat aliquet posuere. Phasellus aliquet dolor arcu, non semper orci congue vitae. Integer sit amet eros quis sapien iaculis vestibulum. Pellentesque imperdiet vestibulum tincidunt. Sed accumsan dui in odio scelerisque tristique. Pellentesque eu nisi et libero euismod posuere. Praesent ut lobortis enim. Aenean ultrices convallis orci a tincidunt. Etiam placerat, metus sit amet maximus aliquam, augue dui tristique orci, in dictum dui felis in.
            </p>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary lang-btn btn-lg" data-dismiss="modal" onclick="initLang('1')"><img src="/typo3/sysext/core/Resources/Public/Icons/Flags/en_us-gb.png">Start in English</button>
            <button type="button" class="btn btn-primary lang-btn btn-lg" data-dismiss="modal" onclick="initLang('0')"><img src="/typo3/sysext/core/Resources/Public/Icons/Flags/PNG/DE.png"> Starten mit Deutsch</button>
        </div>
    </div>
    
## Beispiel Seite für Impressum
    <div class="modal-content lang-content show-de">
        <div class="modal-body">
            <h1 class="modal-title">Impressum DE</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget elit a lacus sollicitudin finibus. Donec sed arcu mauris. Quisque eget fringilla erat. Cras sit amet sagittis nulla. In quis euismod tellus. Nulla pharetra elit risus, at mattis urna dignissim sit amet. Nunc luctus vestibulum mauris, vel tempor lorem luctus vitae.
            </p>
            <br />
            <div class="row imprint-logos">
                <div class="col-3">
                    <img src="/typo3conf/ext/visit_tablets/Resources/Public/Backend/images/ViSIT_Logo_web.png" class="img-fluid">
                </div>
                <div class="col-6">
                    <img src="/typo3conf/ext/visit_tablets/Resources/Public/Backend/images/interreg.png" class="img-fluid">
                </div>
                <div class="col-3">
                    <img src="/typo3conf/ext/visit_tablets/Resources/Public/fh-kufstein.svg" class="img-fluid">
                </div>
            </div>
            <p>
                Vivamus placerat aliquet posuere. Phasellus aliquet dolor arcu, non semper orci congue vitae. Integer sit amet eros quis sapien iaculis vestibulum. Pellentesque imperdiet vestibulum tincidunt. Sed accumsan dui in odio scelerisque tristique. Pellentesque eu nisi et libero euismod posuere. Praesent ut lobortis enim. Aenean ultrices convallis orci a tincidunt. Etiam placerat, metus sit amet maximus aliquam, augue dui tristique orci, in dictum dui felis in.
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary lang-btn btn-lg" data-dismiss="modal">
                Schließen
            </button>
        </div>
    </div>
