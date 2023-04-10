<form action="4-4_complete.php" method="post" name="myform">
    <div class = "formHead">
      <h3>お問い合わせ</h3>
    </div>
      <div class="mainmain">
        <div class="info_c">
          <p>下記の内容をご確認の上送信ボタンを押してください</br>内容を訂正する場合は戻るを押してください。</p>
        </div>

        <dl class="confirm">
          <dt class="borderSet2"><p>氏名</p></dt>
          <dd><?php echo $_POST['fullname'] ?></dd>
          <dt class="borderSet2"><p>フリガナ</p></dt>
          <dd><?php echo $_POST['kananame'] ?></dd>
          <dt class="borderSet2"><p>電話番号</p></dt>
          <dd><?php echo $_POST['number'] ?></dd>
          <dt class="borderSet2"><p>メールアドレス</p></dt>
          <dd><?php echo $_POST['mail'] ?></dd>
          <dt class="borderSet2"><p>お問い合わせ内容</p></dt>
          <dd id="textWrap"><?php echo $_POST['message'] ?></dd>
        </dl>

        <form action="4-4_contact.php" method="post">
          <input type="hidden" name="name" value= <?php echo $_POST['fullname'] ?> >
          <input type="hidden" name="ruby" value= <?php echo $_POST['kananame'] ?> >
          <input type="hidden" name="teleNumber" value= <?php echo $_POST['number'] ?> >
          <input type="hidden" name="Email" value= <?php echo $_POST['mail'] ?> >
          <input type="hidden" name="content" value= <?php echo $_POST['message'] ?> >

          <dd class="confirm_btn">
            <button type="submit">送　信</button>
            <a href="javascript:history.back();">戻　る</a>
          </dd>
        </form>

      </div>

    
    </form>