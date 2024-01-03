<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="x-apple-disable-message-reformatting" />
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--<![endif]-->
  <title></title>
</head>

<body style="
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      background-color: #e7e7e7;
      color: #000000;
    ">
  <table style="max-width: 600px; width:100%; margin: 0 auto; border: 1px solid #000000; background-color: #fafafa;">
    <tbody>
      <tr>
        <th>
          <p style="font-size: 24px; line-height: 28px;">Hello <?php echo htmlspecialchars($user["name"]) . ' ' . htmlspecialchars($user["lastname"]) ?></p>
        </th>
      </tr>
      <tr>
        <td>
          <a href="">
            <img src="" alt="cta image">
          </a>
        </td>
      </tr>
      <tr>
        <a style="padding: 10px 20px; background-color: green;" href="">Click here for more</a>
      </tr>
      <tr>
        <td>
          <p style="font-size: 24px; line-height: 28px;">
            <?php echo htmlspecialchars($message) ?>
          </p>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>