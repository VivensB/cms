var submit = document.getElementById("submitLoad");
import { v4 as uuidv4 } from "https://jspm.dev/uuid";
var txGenCode = uuidv4();
var payLoading = false;
submit.addEventListener("click", function (e) {
  e.preventDefault();
  var amount = document.getElementById("loadAmount").value;
  var phone = document.getElementById("phoneNumber").value;
  // insert data
  var url = "load-balance.php";
  var data = { loadAmount: amount, phoneNumber: phone };

  opayMomoRequest(txGenCode);

  async function pushPaymentDb(transactionGenerated) {
    var data2 = { txId: transactionGenerated, amount: data.loadAmount, phone: data.phoneNumber }
    axios
      .post(url, data2)
      .then(function (res) {
        alert(res.data);
        console.log(res.data)
      })
      .catch(function (error) {
        console.log("error", error);
      });
  }

  async function opayMomoRequest(transactionGenerated) {
    const config = {
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        // "Content-Length": "300",
      },
    };

    const body = JSON.stringify({
      telephoneNumber: phone,
      amount: amount,
      organizationId: "3bb18f64-15a8-4c28-a189-2420fed2cf4e",
      description: "CMS Account loading",
      callbackUrl: "https://www.cmshost.tk/cms/users/customer/callback.php",
      transactionId: transactionGenerated,
    });
    // console.log("TXT Ref 1", transactionGenerated);
    payLoading = true;
    await axios
      .post("https://opay-api.oltranz.com/opay/paymentrequest", body, config)
      .then((response) => {
        if (response.data.status === "PENDING") {
          payLoading = false;
          pushPaymentDb(transactionGenerated);
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
