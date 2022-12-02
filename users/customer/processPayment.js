var submit = document.getElementById("submitTopay");
import { v4 as uuidv4 } from "https://jspm.dev/uuid";
var txGenCode = uuidv4();
var payLoading = false;
submit.addEventListener("click", function (e) {
  e.preventDefault();
  var amount = document.getElementById("AmountToPay").value;
  var phone = document.getElementById("phoneNumberToPay").value;
  var fullname = document.getElementById("empName").value;
  var empRef = document.getElementById("empRef").value;
  var walletBalance = document.getElementById("walletBalance").value;
  // insert data
  var url = "save-payout.php";
  var data = {
    loadAmount: amount,
    phoneNumber: phone,
    fullName: fullname,
    empRef: empRef,
    walletBalance: walletBalance,
  };

  if(amount > walletBalance){
    alert('Insufficient account balance, pleas recharge your CMS account.');
  }else {
    generatePayout(txGenCode);
  }

  async function pushPayoutDb(transactionGenerated) {
    var data2 = {
      txId: transactionGenerated,
      amount: data.loadAmount,
      phone: data.phoneNumber,
      name: data.fullName,
      empRef: data.empRef,
    };
    axios
      .post(url, data2)
      .then(function (res) {
        alert(res.data);
        console.log(res.data);
      })
      .catch(function (error) {
        console.log("error", error);
      });
  }

  async function generatePayout(transactionGenerated) {
    const config = {
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        accesskey: "4554e8905c3411ecb02c69b80d19a2d24554e8915c3411ecb02c69b80d19a2d24554e8925c3411ecb02c",
        // "Content-Length": "300",
      },
    };

    const body = JSON.stringify({
      amount: amount,
      //   callbackUrl: "http://localhost/cms/users/customer/payouts-callback.php",
      callbackUrl: "https://www.cmshost.tk/cms/users/customer/payouts-callback.php",
      transactionId: transactionGenerated,
      merchantId: "3bb18f64-15a8-4c28-a189-2420fed2cf4e",
      receiverAccount: phone,
      type: "MOBILE",
      description: "CMS Payment",
      firstName: fullname.split(" ")[0],
      lastName: fullname.split(" ")[1],
    });
    // console.log("TXT Ref 1", transactionGenerated);
    payLoading = true;
    await axios
      .post(
        "https://opay-api.oltranz.com/opay/wallet/fundstransfer",
        body,
        config
      )
      .then((response) => {
        if (response.data.status === "PENDING") {
          payLoading = false;
          pushPayoutDb(transactionGenerated);
          alert(response.data.description);
        } else if (response.data.status === "FAILED") {
          payLoading = false;
          alert(response.data.description);
        } else if (response.data.errors.length) {
          payLoading = false;
          alert(response.data.errors[0].msg);
        } else {
          payLoading = false;
          alert(response.data.description);
        }
      })
      .catch((error) => {
        payLoading = false;
        alert(error.message);
      });
  }
});
