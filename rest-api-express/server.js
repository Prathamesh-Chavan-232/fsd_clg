import express from "express";
import { readFile } from "fs";
import path from "path";

const app = express();
const port = 3000;
const __dirname = path.resolve();

app.get("/", (req, res) => {
  res.end("Welcome to my REST api");
});

app.get("/my-data", (req, res) => {
  readFile(__dirname + "/" + "data.json", "utf8", (err, data) => {
    res.end(data);
  });
});

app.listen(port, () => {
  console.log(`app listening at http://localhost:${port}`);
});
