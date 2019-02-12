Vue.filter('formatNumber', function(value) {
    if (!value) return '';
    return numeral(value).format('0,0.00');
});
Vue.filter('formatInt', function(value) {
    if (!value) return '';
    return numeral(value).format('0,0');
});