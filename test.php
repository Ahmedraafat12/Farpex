<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .quantity-sys {
            width: 120px; /* زيادة عرض الحاوية قليلاً لتناسب الأزرار والحقل النصي بشكل أفضل */
            height: auto;
            position: relative;
        }

        .quantity-sys button {
            font-size: 18px;
            border: none;
            background-color: #eee;
            padding: 3px 10px;
            cursor: pointer;
            outline: none; /* إزالة التأثير الظاهري عند النقر على الأزرار */
            position: absolute;
            top: 0;
        }

        #plus-btn {
            right: 0;
        }

        .quantity-sys input[type=text] {
            width: 60px; /* تقليل عرض حقل النص ليناسب الأزرار */
            font-size: 17px;
            text-align: center;
            border: none;
            outline: none;
            padding: 3px;
            -moz-appearance: none;
            -webkit-appearance: none;
        }
    </style>
</head>
<body>
    <div class="quantity-sys">
        <button id="plus-btn" onclick="add_num();">+</button>
        <input id="input-num" type="text" value="1" onkeydown="check_num();">
        <button id="minus-btn" onclick="remove_num();">-</button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function add_num() {
            var get_num = $("#input-num").val();
            var make_calc = parseInt(get_num) + 1;
            if (isNaN(make_calc) || make_calc < 1) { // تحقق من أن القيمة هي رقم صالح وأكبر من 1
                $("#input-num").val("1");
            } else {
                $("#input-num").val(make_calc);
            }
        }
        
        function remove_num() {
            var get_num = $("#input-num").val();
            var make_calc = parseInt(get_num) - 1;
            if (isNaN(make_calc) || make_calc < 1) { // تحقق من أن القيمة هي رقم صالح وأكبر من 1
                $("#input-num").val("1");
            } else {
                $("#input-num").val(make_calc);
            }
        }

        function check_num() {
            var get_num = $("#input-num").val();
            if (get_num === "" || get_num === "0" || isNaN(get_num) || parseInt(get_num) < 1) { // تحقق من أن القيمة هي رقم صالح وأكبر من 1
                $("#input-num").val("1");
            }
        }
    </script>
</body>
</html>
