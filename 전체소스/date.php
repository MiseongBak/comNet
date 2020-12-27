<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="/calendar/date.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <title>COMnet</title>
</head>
<body>
  <div class="main">
    <div class="content-wrap">
      <div class="content-left">
        <div class="main-wrap">
          <div id="main-day" class="main-day"></div>
          <div id="main-date" class="main-date"></div>
        </div>
        <div class="todo-wrap">
          <div class="todo-title">Todo List</div>
          <div class="input-wrap">
            <input type="text" placeholder="please write here!!" id="input-box" class="input-box">
            <button type="button" id="input-data" class="input-data">INPUT</button>
            <div id="input-list" class="input-list"></div>
          </div>
        </div>
      </div>
      <div class="content-right">
        <table id="calendar" align="center">
          <thead>
            <tr class="btn-wrap clearfix">
              <td>
                <label id="prev">
                    &#60;
                </label>
              </td>
              <td align="center" id="current-year-month" colspan="5"></td>
              <td>
                <label id="next">
                    &#62;
                </label>
              </td>
            </tr>
            <tr>
                <td class = "sun" align="center">S</td>
                <td align="center">M</td>
                <td align="center">T</td>
                <td align="center">W</td>
                <td align="center">T</td>
                <td align="center">F</td>
                <td class= "sat" align="center">S</td>
              </tr>
          </thead>
          <tbody id="calendar-body" class="calendar-body"></tbody>
        </table>
      </div>
    </div>
  </div>
  <style>
  /* 스크롤 바 넓이 16px */
  ::-webkit-scrollbar{width: 16px;}
  /* 스크롤 바 기본 색상 */
  ::-webkit-scrollbar-track {background-color:thistle;}
  /* 스크롤 구간 배경 색상 */
  ::-webkit-scrollbar-thumb {background-color:slateblue;}
  /* 스크롤 바 위에 마우스 올렸을 때(hover) 색상 */
  ::-webkit-scrollbar-thumb:hover {background-color: blueviolet;}
  /* 스크롤 상하단 버튼 넓이와 색상 */
  ::-webkit-scrollbar-button:start:decrement, ::-webkit-scrollbar-button:end:increment {
    width:16px; height:16px; background-color: mediumpurple;
  }
</style>
  <script src="/calendar/date1.js?v=<?=$t?>" type="text/javascript"></script>
  <script src="/calendar/date2.js?v=<?=$t?>" type="text/javascript"></script>
  <script src="/calendar/date3.js?v=<?=$t?>" type="text/javascript"></script>
  <script src="/calendar/date4.js?v=<?=$t?>" type="text/javascript"></script>
</body>
</html>
