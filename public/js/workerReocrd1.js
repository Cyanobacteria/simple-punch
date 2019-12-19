//網頁讀取完畢-才執行
window.onload = function() {
    let workRecord = this.document.getElementById("workRecord");

    //監聽事件
    workRecord.addEventListener("click", event => {
        if (event.target.tagName === "BUTTON") {
            //取得事件使用者打卡資料
            let punchRecordId = event.target.dataset.punchrecordid;
            let userId = event.target.dataset.userid;
            let userName = event.target.dataset.username;
            let punchTime =
                event.target.parentElement.previousElementSibling
                    .previousElementSibling.textContent;
            let punchResult =
                event.target.parentElement.previousElementSibling
                    .previousElementSibling.previousElementSibling.textContent;
            let punchRemark =
                event.target.parentElement.previousElementSibling.textContent;
            //鎖定提示卡片
            let modalWorkerpunchId = this.document.getElementById("punchid");
            let modalWorkerName = this.document.getElementById("workname");
            let modalWorkerTime = this.document.getElementById("workpunchtime");
            let workpunchresult = this.document.getElementById(
                "workpunchresult"
            );
            let workpunchremark = this.document.getElementById(
                "workpunchremark"
            );
            let resultOptions = workpunchresult.children;
            //填入資料

            modalWorkerpunchId.value = punchRecordId;
            modalWorkerName.value = userName;
            modalWorkerTime.value = punchTime;
            workpunchremark.value = punchRemark;

            this.Object.keys(resultOptions).forEach(optionKey => {
                if (resultOptions[optionKey].textContent == punchResult) {
                    resultOptions[optionKey].setAttribute("selected", "");
                }
            });
        }
    });
    //
};
