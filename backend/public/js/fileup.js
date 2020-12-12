$(function(){
  // .fileに変化があった場合
  // $(".file").on('change', function(){
  $(document).on("change", ".file", function() {
     // 変数定義
     var fileprop = $(this).prop('files')[0],
       find_img_main = $(this).parents('form').find('.view_box_main').find('img'),
       find_img_small = $(this).parent().find('img'),
       filereader = new FileReader(),
       view_box_main = $(this).parents('form').find('.view_box_main');
       view_box_small = $(this).parent('.view_box_small');
       img_view_main = $(view_box_main).find('.img_view_main');
       img_view_small = $(this).next();
       img_input = $(this).parents('.img_input');

    // inputを追加
    var name = $(this).attr('name');
    if (name == 'file[0]'){
      var num = 1;
    } else if (name == 'file[1]'){
      var num = 2;
    } else if (name == 'file[2]'){
      var num = 3;
    } else if (name == 'file[3]'){
      var num = 4;
    } else {
      var num = 0;
    }
    if (num!=0){
      var add_input = '<div class="view_box_small"><label>画像'+(num+1)+'</label><input type="file" class="file" name="file['+num+']"><div class="img_view_small"><p><img src="/img/defaultImage.png"></p></div></div>';
      img_input.append(add_input);
    }

    // defalt画像をremove
    if(find_img_small.length){
       find_img_small.nextAll().remove();
       find_img_small.remove();
    }
    if(find_img_main.length){
       find_img_main.nextAll().remove();
       find_img_main.remove();
    }
    
    // image_viewの中に追加
    // main
    var img_m = '<img alt="" class="img">';
    img_view_main.append(img_m);
    // small
    var img_s = '<img alt="" class="img"><p><a href="#" class="img_del">画像を削除する</a></p>';
    img_view_small.append(img_s);

    // 画像のsrcを更新
    filereader.onload = function() {
      view_box_small.find('img').attr('src', filereader.result);
      img_del(view_box_small);
      view_box_main.find('img').attr('src', filereader.result);
      img_del(view_box_main);
    }
    filereader.readAsDataURL(fileprop);
  });
   
  // 画像を削除
  function img_del(target){
    target.find("a.img_del").on('click',function(){
      var self = $(this),
          parentBox = self.parent().parent().parent();
      if(window.confirm('画像を削除します。\nよろしいですか？')){
        setTimeout(function(){
          parentBox.find('input[type=file]').val('');
          // 設定した画像をremove
          parentBox.find('.img').remove();
          // 削除aタグをremove
          parentBox.find('.img_del').remove();
          // default画像を追加
          var img_default = '<img src="/img/defaultImage.png">';
          parentBox.find('.img_view_small').append(img_default);
        } , 0);            
      }
      return false;
    });
  }  
     
});