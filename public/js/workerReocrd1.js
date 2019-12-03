//網頁讀取完畢-才執行
window.onload = function() {
    console.log("this is v-----1");
    let workRecord = this.document.getElementById("workRecord");
    let punchModal = this.document.getElementById("exampleModalCenter1");
    //監聽事件 -  編輯單筆員工打卡紀錄
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
    //監聽事件 - 管理者代打卡-資料驗證
    punchModal.addEventListener("click", event => {
        if (event.target.id === "adminpunch") {
            //檢查每一個欄位不得為空
            //員工姓名
            let workerName = this.document.getElementById("punchworkername")
                .value;
            //日期
            let punchDate = this.document.getElementById("punchdate").value;
            //班別
            let punchType = this.document.getElementById("punchtype").value;
            //假別
            let punchAction = this.document.getElementById("punchaction").value;
            //備註
            let remark = this.document.getElementById("punchremark").value;
            console.log(
                `${workerName}${punchDate}${punchType}${punchAction}${remark}`
            );
        }
    });
};
