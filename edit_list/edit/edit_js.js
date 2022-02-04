$(function() {
    "use strict";

var jobtitlestr = $('.field:last-child').find('.kyujin_no').text();
var num = jobtitlestr.replace(/[^0-9^\.]/g,"");
var $content = $('.field:last-child');

var $content2 = $('.timeparent');
//求人番号初期設定
var kyujin_num = num;
var kyujin_title = "求人登録情報";
num = 0;

//上場企業チェック初期設定
if($('#comp_key_jou').prop('checked')){
$('#comp_code').prop('disabled',false);
$('#comp_agesal').prop('disabled',true);
}else{
$('#comp_code').prop('disabled',true);
$('#comp_agesal').prop('disabled',false);
}
//上場企業チェック後の処理
$('#comp_key_jou').change(function() {
if($(this).prop('checked')){
$('#comp_code').prop('disabled',false);
$('#comp_agesal').prop('disabled',true);
}else{
$('#comp_code').prop('disabled',true);
$('#comp_agesal').prop('disabled',false);
}
});


//掲載期間表示処理
$(document).on('click', '.time_btn' ,function(){
$(this).parent().parent().find('input').each(function(){
$(this).prop("readonly",false);
$(this).attr('type','date');
});
});

//求人数をvalueで送信
$(document).on('click','#confirm', function() {
$(this).val(kyujin_num);
});

//追加ボタン処理
$(document).on('click','.add_btn', function() {
   num++;
   kyujin_num++;

   //クローン作成処理
   $content.clone().appendTo('.parent').find('input,textarea,select').each(function() {
    var base_name = $(this).attr('name');
    var bnr = base_name.replace(/\[[0-9]\]/g,"");//正規表現で[0-9]を削除
    var base_name2 = $(this).attr('id');
    var bnr2 = base_name2.replace(/\[[0-9]\]+$/g ,"");

    //[0-9]を削除後の処理
    if(bnr.match(/\[\]/)){    //selectなど[]が残っていた場合の処理
        var bnr_1 =bnr.replace(/\[\]/g,"");  //正規表現で[]を削除
        $(this).attr('name', bnr_1 + '[' + num + ']' + '[]');
    } else {
        $(this).attr('name', bnr + '[' + num + ']');
    }

    $(this).attr('id', bnr2 + '[' + num + ']');

//クローンフォーム内のクリア処理

//checkedをクリア
if($(this).attr('type') === 'checkbox' ){
$(this).prop("checked",false);
} else {
$(this).val('');//valueをクリア
}

  }).end().find('label').each(function() {
    //label内forに対する処理
    var base_name4 = $(this).attr('for');
    var bnr4 = base_name4.replace(/\[[0-9]\]+$/g ,"");
    $(this).attr('for', bnr4 + '[' + num + ']');

  }).end().find('.kyujin_no').text(kyujin_title + kyujin_num);//求人番号設定処理


});

//削除ボタン処理
$(document).on('click','.trash_btn', function() {
   num--;
   kyujin_num--;
   $(this).parents('.field').remove();

$('.parent').find('.field').each(function(i,e) {
//求人番号設定処理
var knum = i + 1;
$(this).find('.kyujin_no').text(kyujin_title + knum );

//nameをindex番号に置き換え処理
$(this).find('input,textarea,select').each(function() {
var rename = $(this).attr('name');
var rn1 = rename.replace(/[0-9]/g , i);
var rename2 = $(this).attr('id');
var rn2 = rename2.replace(/[0-9]/g , i);
$(this).attr('name', rn1);
$(this).attr('id', rn2);

}).end().find('label').each(function() {
//forをindex番号に置き換え処理
var rename3 = $(this).attr('for');
var rn3 = rename3.replace(/[0-9]/g , i);
$(this).attr('for', rn3);

  });


});


});


//リセットボタン処理
$(document).on('click','.clearForm', function(){
    $(this).parents('.field').find("input,textarea,select").val("").end().find(":checked").prop("checked", false);
});

//戻すボタン処理
//先ず初期値をdata()でdefaultに保存
$('input,textarea').each(function(){

$(this).data('default',$(this).val());

}).end().find('input[type="checkbox"]:checked,option:selected').each(function(){
//チェックボックスとセレクトボックスは選択されている要素にdata-要素を追加する
$(this).data('default',$(this).val());
});

//戻すボタンクリック後の処理
$(document).on('click','.vclear', function(){

$(this).parents('.field').find("input,textarea").val(function(){
return $(this).data('default');
}).end().find('input[type="checkbox"],option').each(function(){
//alert($(this).data('default'));
//data-要素のあるオブジェクトに選択済みを追加する
if($(this).attr('checked') || $(this).attr('selected')){
//alert($(this).data('default'));
$(this).prop("checked", true);
$(this).prop("selected", true);
}else{
$(this).prop("checked", false);
$(this).prop("selected", false);
};


});

});


//URL追加ボタン処理
var urlnum = 0;
var $urlcontent = $('.urlfield:last-child');
$(document).on('click','.add_review_btn', function(){
urlnum++;
  
   //クローン作成処理
   $urlcontent.clone().appendTo('.urlparent').find('input').each(function() {
    var url_name = $(this).attr('name');
    var urlna1 = url_name.replace(/\[[0-9]\]/g,"");//正規表現で[0-9]を削除
    var url_name2 = $(this).attr('id');
    var urlna2 = url_name2.replace(/\[[0-9]\]+$/g ,"");

        $(this).attr('name', urlna1 + '[' + urlnum + ']');
        $(this).attr('id', urlna2 + '[' + urlnum + ']');
        $(this).val('');//valueをクリア

    });
/*
.end().find('label').each(function(){

    var url_name4 = $(this).attr('for');
    var urlna4 = url_name4.replace(/\[[0-9]\]+$/g ,"");
    $(this).attr('for', urlna4 + '[' + urlnum + ']');

});
*/

});

//URL削除ボタン処理
$(document).on('click','.trash_review_btn', function(){
urlnum--;
$(this).parents('.urlfield').remove();

$('.urlparent').find('.urlfield').each(function(i,e) {

$(this).find('input').each (function() {
var urlrename = $(this).attr('name');
var urlrn1 = urlrename.replace(/[0-9]/g , i);
var urlrename2 = $(this).attr('id');
var urlrn2 = urlrename2.replace(/[0-9]/g , i);
$(this).attr('name', urlrn1);
$(this).attr('id', urlrn2);

}).end().find('label').each(function() {
var urlrename3 = $(this).attr('for');
var urlrn3 = urlrename3.replace(/[0-9]/g , i);
$(this).attr('for', urlrn3);
});

});

});

//フォーム入力チェック処理
$('form').on('submit',function(){
  var chksub = "";
  var chkcom = "";
  if($("#comp_name").val() === ""){
  chksub = false;
  chkcom += "企業名が入力されていません\n";
  $("#comp_name").after('<span class="text-danger">企業名を入力して下さい</span>');
  }

  if($("#comp_gyo").val() === ""){
  chksub = false;
  chkcom += "業種が入力されていません\n";
  $("#comp_gyo").after('<span class="text-danger">業種を入力して下さい</span>');
  }

//求人数ごとの入力値カウント初期設定
var cnt_syok = 0;var cnt_plc = 0;var cnt_sty = 0;var cnt_sal = 0;var cnt_url = 0;var cnt_time = 0;
//selectボックスの入力値チェック分岐処理
$(this).find('select').each(function(){

if($(this).attr('id').match(/carr_syok/) ){
cnt_syok++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_syok + "の職種が入力されていません\n";
  $(this).after('<span class="text-danger">職種を選択して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_plc/ )){
cnt_plc++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_plc + "の勤務地が入力されていません\n";
  $(this).after('<span class="text-danger">勤務地を選択して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_sty/ )){
cnt_sty++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_sty + "の雇用形態が入力されていません\n";
  $(this).after('<span class="text-danger">雇用形態を選択して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_sal/ )){
cnt_sal++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_sal + "の給与が入力されていません\n";
  $(this).after('<span class="text-danger">給与を選択して下さい</span>');
  }
}

}).end().find('input').each(function(){

if($(this).attr('id').match(/carr_url/ )){
cnt_url++;
 if($(this).val() === ""){
  chksub = false;
  chkcom  += "求人No" + cnt_url + "のurlが入力されていません\n";
  $(this).after('<span class="text-danger">求人ページのURLを入力して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_time/ )){
cnt_time++;
 if($(this).val() === ""){
  chksub = false;
  chkcom  += "求人No" + cnt_time + "のurlが入力されていません\n";
  $(this).after('<span class="text-danger">掲載期間を選択して下さい</span>');
  }
}


});

//未入力・未選択があった場合の処理
  if( chksub === false ){
    alert(chkcom);
    return false;
  }

});


});