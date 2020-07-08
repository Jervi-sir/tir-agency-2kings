/*Date Picker*/

var rangeText = function (start, end) {
        var str = '';
        str += start ? start.format('Do MMMM YYYY') + ' to ' : '';
        str += end ? end.format('Do MMMM YYYY') : '...';

        return str;
    },
    css = function(url){
        var head  = document.getElementsByTagName('head')[0];
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.type = 'text/css';
        link.href = url;
        head.appendChild(link);
    },
    script = function (url) {
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url;
        var head  = document.getElementsByTagName('head')[0];
        head.appendChild(s);
    }
    callbackJson = function(json){
        var id = json.files[0].replace(/\D/g,'');
        document.getElementById('gist-' + id).innerHTML = json.div;

        if (!document.querySelector('link[href="' + json.stylesheet  + '"]')) {
            css(json.stylesheet);
        }
    };




// demo-3
new Lightpick({
    field: document.getElementById('demo-3_1'),
    secondField: document.getElementById('demo-3_2'),

});

// demo-4

new Lightpick({
    field: document.getElementById('demo-4_1'),
    secondField: document.getElementById('demo-4_2'),

});

// demo-5
new Lightpick({
    field: document.getElementById('demo-5_1'),
    secondField: document.getElementById('demo-5_2'),

});

// demo-6

new Lightpick({
    field: document.getElementById('demo-6_1'),
    secondField: document.getElementById('demo-6_2'),

});

