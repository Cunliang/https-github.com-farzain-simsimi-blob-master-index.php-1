const line = require('@line/bot-sdk');
const express = require('express');
const axios = require('axios');

const config = {
  channelAccessToken: "jEFctXuQ+0y5wCcgyilX5hFx5TghXGe3zsLbEcQ1pm3GiRvPNPb/uSGvF1J7z8/LMaesMtrhwzfMkdYfTVVP06RX3Wl4QqfqebxrceVej3L45csspum/0kTtjPmsPbKZnBQF/vM14g0dmYBx60uukQdB04t89/1O/w1cDnyilFU=",
  channelSecret: "d3fd37632ca0ea18853d87ba11a72600",
};

// create LINE SDK client
const client = new line.Client(config);
const app = express();

// register a webhook handler with middleware
// about the middleware, please refer to doc
app.post('/callback', line.middleware(config), (req, res) => {
  Promise
    .all(req.body.events.map(handleEvent))
    .then((result) => res.json(result))
    .catch((e)=>{
      console.log(e);
    });

});

function handleEvent(event) {
  
    if(event.message.text == "hai"){
      const echo = { type: 'text', text: "Halo juga :)·" };
      return client.replyMessage(event.replyToken, echo);
    }

    const echo = { type: 'text', text: "Saya tidak mengerti, saya simpan dulu" };
    return client.replyMessage(event.replyToken, echo);
}

// listen on port
const port = 3000;
app.listen(port, () => {
  console.log(`listening on ${port}`);
});
