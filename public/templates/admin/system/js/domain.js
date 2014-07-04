	var CONFIG = (function() {
     var private = {
         'DOMAIN': jQuery('#baseUrl').attr('value'),
         'DOCUMENT_ROOT':jQuery('#documentRoot').attr('value')
     };

     return {
        get: function(name) { return private[name]; }
    };
})();
    