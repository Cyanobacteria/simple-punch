//網頁讀取完畢-才執行
window.onload = function() {
    this.console.log("water in the house");
    let punchForm = document.getElementById("punchForm");

    //事件監聽-打卡結果判定
    punchForm.addEventListener("click", event => {
        //

        if (this.event.target.id == "punchSubmit") {
            let shiftType = document.getElementById("shiftType").value;
            let punchType = document.getElementById("punchType").value;
            let remarkText = document.getElementById("remark").lastElementChild
                .value;
            let punchResult = checkPunchResult(
                Number(shiftType),
                Number(punchType)
            );
            //寫入punchResult
            let punchText = document.getElementById("punchResult");
            punchText.value = punchResult;
            //打卡結果異常｜遲到/早退 且 無輸入事由
            if (punchResult != 3 && remarkText.length < 1) {
                //中止提交
                this.event.preventDefault();

                //顯示提示訊息
                this.alert("你已遲到 / 早退 ｜ 請輸入原因 ");
                //顯示remark 欄位
                let remarkDiv = document.getElementById("remark").classList;
                remarkDiv.remove("d-none");
            }
        }
    });

    //遲到早退-判定
    function checkPunchResult(shiftType, punchType) {
        let time = new Date();
        let todayDate = `${time.getFullYear()}-${time.getMonth() +
            1}-${time.getDate()} 00:00:00`;
        let millisecondsToday = Number(Date.parse(todayDate));
        let millisecondsNow = Number(Date.now());
        let am09 = 3600000 * 9;
        let pm12 = 3600000 * 12;
        let pm13 = 3600000 * 13;
        let pm18 = 3600000 * 18;
        let result = "";
        let punchResult = "";

        //判斷式
        if (shiftType == 1) {
            //早班
            //遲到判斷 09
            if (punchType == 1 && millisecondsNow > millisecondsToday + am09) {
                result = "遲到";
            } else if (
                punchType == 2 &&
                millisecondsNow < millisecondsToday + pm12
            ) {
                //早退判斷 12
                result = "早退";
            } else {
                result = "正常";
            }
        } else if (shiftType == 2) {
            //午班

            //遲到判斷 13
            if (punchType == 1 && millisecondsNow > millisecondsToday + pm13) {
                result = "遲到";
            } else if (
                punchType == 2 &&
                millisecondsNow < millisecondsToday + pm18
            ) {
                //早退判斷 18
                result = "早退";
            } else {
                result = "正常";
            }
        } else if (shiftType == 3) {
            //全天班

            //遲到判斷 09
            if (punchType == 1 && millisecondsNow > millisecondsToday + am09) {
                result = "遲到";
            } else if (
                punchType == 2 &&
                millisecondsNow < millisecondsToday + pm18
            ) {
                //早退判斷 18
                result = "早退";
            } else {
                result = "正常";
            }
        }else if(shiftType == 9) {
            //星期三早退
            if (punchType == 1 && millisecondsNow > millisecondsToday + am09) {
                result = "遲到";
            } else if (
                punchType == 2 &&
                millisecondsNow < millisecondsToday + pm18
            ) {
                //早退判斷 18
                result = "早退";
            } else {
                result = "正常";
            }

        }
        // return result;

        if (result == "正常") {
            punchResult = 3;
        } else if (result == "遲到") {
            punchResult = 1;
        } else if (result == "早退") {
            punchResult = 2;
        }

        return punchResult;
    }
};
