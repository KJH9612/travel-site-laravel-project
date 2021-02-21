/**
 * handle counter
 */
;(function () {
    'use strict';
    $.fn.handleCounter = function (options) {
        var $input,
            $btnMinus,
            $btnPlugs,
            minimum,
            maximize,
            writable,
            onChange,
            onMinimum,
            onMaximize;
        var $handleCounter = this
        $btnMinus = $handleCounter.find('.counter-minus')
        $input = $handleCounter.find('input')
        $btnPlugs = $handleCounter.find('.counter-plus')
        var defaultOpts = {
            writable: true,
            minimum: 1,
            maximize: null,
            onChange: function(){},
            onMinimum: function(){},
            onMaximize: function(){}
        }
        var settings = $.extend({}, defaultOpts, options)
        minimum = settings.minimum
        maximize = settings.maximize
        writable = settings.writable
        onChange = settings.onChange
        onMinimum = settings.onMinimum
        onMaximize = settings.onMaximize
        if (!$.isNumeric(minimum)) {
            minimum = defaultOpts.minimum
        }
        if (!$.isNumeric(maximize)) {
            maximize = defaultOpts.maximize
        }
        var inputVal = $input.val()
        if (isNaN(parseInt(inputVal))) {
            inputVal = $input.val(0).val()
        }
        if (!writable) {
            $input.prop('disabled', true)
        }

        changeVal(inputVal)
        $input.val(inputVal)
        $btnMinus.click(function () {
            var num = parseInt($input.val())
            if (num > minimum) {
                $input.val(num - 1)
                changeVal(num - 1)
				fn_check()				
            }
        })
        $btnPlugs.click(function () {
            var num = parseInt($input.val())
            if (maximize==null||num < maximize) {
                $input.val(num + 1)
                changeVal(num + 1)
				fn_check()
            }
        })
        var keyUpTime
        $input.keyup(function () {
            clearTimeout(keyUpTime)
            keyUpTime = setTimeout(function() {
                var num = $input.val()
                if (num == ''){
                    num = minimum
                    $input.val(minimum)
                }
                var reg = new RegExp("^[\\d]*$")
                if (isNaN(parseInt(num)) || !reg.test(num)) {
                    $input.val($input.data('num'))
                    changeVal($input.data('num'))
                } else if (num < minimum) {
                    $input.val(minimum)
                    changeVal(minimum)
                }else if (maximize!=null&&num > maximize) {
                    $input.val(maximize)
                    changeVal(maximize)
                } else {
                    changeVal(num)
                }
            },300)
        })
        $input.focus(function () {
            var num = $input.val()
            if (num == 0) $input.select()
        })

        function changeVal(num) {
            $input.data('num', num)
            $btnMinus.prop('disabled', false)
            $btnPlugs.prop('disabled', false)
            if (num <= minimum) {
                $btnMinus.prop('disabled', true)
                onMinimum.call(this, num)
            } else if (maximize!=null&&num >= maximize) {
                $btnPlugs.prop('disabled', true)
                onMaximize.call(this, num)
            }
            onChange.call(this, num)
        }

		function fn_check(){
			var chkRadio = document.getElementsByName('roomtype');
			var rname = 'roomprice';		
			var anum = document.getElementById('adult').value;
			var cnum = document.getElementById('child').value;

			for(var i=0;i<chkRadio.length;i++){
				if(chkRadio[i].checked == true) 
				rname = rname.concat(chkRadio[i].value);
			}
			
			var chkin = document.getElementById('check_in').value;
			var chkout = document.getElementById('check_out').value;
			var arr1 = chkin.split('-');		
			var arr2 = chkout.split('-');
			var date1 = new Date(arr1[0],arr1[1],arr1[2]);
			var date2 = new Date(arr2[0],arr2[1],arr2[2]);

			var elapsedMSec = date2.getTime() - date1.getTime(); // 172800000
			var elapsedDay = elapsedMSec / 1000 / 60 / 60 / 24; // 2

			var price = document.getElementById(rname).value;
			
			if(isNaN(elapsedDay)==false)
				total = price * 1 * anum * elapsedDay + price * 1 / 2 * cnum * elapsedDay;

			var real = comma(total)

			document.getElementById("price").value = real + '원';
			document.getElementById("realprice").value = total;
		}

		function comma(num){
		var len, point, str; 
		   
		num = num + ""; 
		point = num.length % 3 ;
		len = num.length; 
	   
		str = num.substring(0, point); 
		while (point < len) { 
			if (str != "") str += ","; 
			str += num.substring(point, point + 3); 
			point += 3; 
		} 
		 
		return str; 
	}

        return $handleCounter
    };
})(jQuery)