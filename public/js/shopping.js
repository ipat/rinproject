$(document).ready(function() {
	$('.number-item').TouchSpin({
        min: 0,
        max: 100,
        step: 1,
        decimals: 0,
        boostat: 5,
        maxboostedstep: 10,
        postfix: 'ชิ้น'
    });
});