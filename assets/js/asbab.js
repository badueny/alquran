$(() => {
    heyzineDesign.load(flipbookcfg.design);
    heyzine.load(URL_BASE+'files/uploaded/v2/8c13143aa81e533f03ea733d45f9b929cd3b95da.pdf', flipbookcfg).then(() => {				
        heyzineDesign.afterLoad(flipbookcfg.design);             
        if (typeof app != 'undefined' && app != null && app.bus != null) {
            app.bus().$emit('flipbookLoaded');
        }
    });            
});