<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="{{ asset('img/Artboard 3.png') }}"/>
    <title>Static Template</title>

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
  </head>
  <body
    style="
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
      font-size: 14px;
    "
  >
    <div
      style="
        max-width: 680px;
        margin: 0 auto;
        padding: 45px 30px 60px;
        background: #9de8ff;
        background-image: url(https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661497957196_595865/email-template-background-banner);
        background-repeat: no-repeat;
        background-size: 800px 452px;
        background-position: top center;
        font-size: 14px;
        color: #434343;
      "
    >
      <header>
        <table style="width: 100%;">
          <tbody>
            <tr style="height: 0;">
              <td>
              <img  src="https://sinhvien.ctuet.edu.vn/Content/AConfig/images/sv_logo_dashboard.png"></img>
              </td>
            </tr>
          </tbody>
        </table>
      </header>
      <main>
        <div
          style="
            margin: 0;
            margin-top: 70px;
            padding: 92px 30px 115px;
            background: #ffffff;
            border-radius: 30px;
            text-align: center;
          "
        >
          <div style="width: 100%; max-width: 489px; margin: 0 auto;">
            <h1
              style="
                margin: 0;
                font-size: 24px;
                font-weight: 700;
                color: #1f1f1f;
              "
            >
              Hello {{$Ten}}
            </h1>
         
  
          <div style=" font-size: 17px;;margin: 0;margin-top: 17px;font-weight: 600;">Chúc mừng {{$Ten}} đã đăng ký thành công !</div>
          <div style="
              font-size: 16px;
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
              ">Hy vọng rằng bạn sẽ tận hưởng mọi khoá học và trải nghiệm học tập tuyệt vời tại đây. Chúng tôi sẽ luôn ở đây để hỗ trợ bạn trong mọi bước trên con đường học tập và phát triển. 
          </div>  
          </div>
        </div>

        <p
          style="
            max-width: 400px;
            margin: 0 auto;
            margin-top: 90px;
            text-align: center;
            font-weight: 500;
            color: #000000;
          "
        >
          Need help? Ask at
          <a
            href="mailto:archisketch@gmail.com"
            style="color: #00547d; text-decoration: none;"
            >archisketch@gmail.com</a
          >
          or visit our
          <a
            href=""
            target="_blank"
            style="color: #00547d; text-decoration: none;"
            >Help Center</a
          >
        </p>
      </main>
    </div>
  </body>
</html>
