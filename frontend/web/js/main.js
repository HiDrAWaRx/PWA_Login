/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('.showPwSignup').click(function () {
        var type = $('#signupform-password').attr("type");
        // now test it's value
        if (type === 'password') {
            $('#signupform-password').attr("type", "text");
        } else {
            $('#signupform-password').attr("type", "password");
        }
    });
    $('.showPwLogin').click(function () {
        var type = $('#loginform-password').attr("type");
        // now test it's value
        if (type === 'password') {
            $('#loginform-password').attr("type", "text");
        } else {
            $('#loginform-password').attr("type", "password");
        }
    });
});