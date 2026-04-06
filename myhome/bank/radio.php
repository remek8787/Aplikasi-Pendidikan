<style>
 /* custom radio */
.radio {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 5px;
    cursor: pointer;
    font-size: 20px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 
/* hide the browser's default radio button */
.radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
 
/* create custom radio */
.radio .check {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 50%;
}
 
/* on mouse-over, add border color */
.radio:hover input ~ .check {
    border: 2px solid #2489C5;
}
 
/* add background color when the radio is checked */
.radio input:checked ~ .check {
    background-color: #2489C5;
    border:none;
}
 
/* create the radio and hide when not checked */
.radio .check:after {
    content: "";
    position: absolute;
    display: none;
}
 
/* show the radio when checked */
.radio input:checked ~ .check:after {
    display: block;
}
 
/* radio style */
.radio .check:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
/* custom checkbox */
.checkbox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 13px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 
/* hide the browser's default checkbox */
.checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
 
/* create custom checkbox */
.check {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border: 1px solid #ccc;
}
 
/* on mouse-over, add border color */
.checkbox:hover input ~ .check {
    border: 2px solid #2489C5;
}
 
/* add background color when the checkbox is checked */
.checkbox input:checked ~ .check {
    background-color: #2489C5;
    border:none;
}
 
/* create the checkmark and hide when not checked */
.check:after {
    content: "";
    position: absolute;
    display: none;
}
 
/* show the checkmark when checked */
.checkbox input:checked ~ .check:after {
    display: block;
}
 
/* checkmark style */
.checkbox .check:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

</style>
 