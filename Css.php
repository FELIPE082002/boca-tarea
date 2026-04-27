<?php
////////////////////////////////////////////////////////////////////////////////
//BOCA Online Contest Administrator
//    Copyright (C) 2003-2012 by BOCA Development Team (bocasystem@gmail.com)
//
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.
////////////////////////////////////////////////////////////////////////////////
// Last modified 05/aug/2012 by cassio@ime.usp.br
$corfundo = "#f4f6fb";
$corfrente = "#1e293b";
$corfundo2 = "#eef2f7";
$cormenu = "#e8edf5";
?>
:root {
  --boca-bg: #f4f6fb;
  --boca-surface: #ffffff;
  --boca-text: #1e293b;
  --boca-muted: #64748b;
  --boca-border: #e2e8f0;
  --boca-accent: #2563eb;
  --boca-accent-soft: #dbeafe;
  --boca-radius: 6px;
  --boca-font: system-ui, -apple-system, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Arial, sans-serif;
  --boca-mono: ui-monospace, "Cascadia Code", "Source Code Pro", Menlo, Consolas, monospace;
}

div#popupnew {
  position: absolute;
  left: 50%;
  top: 17%;
  margin-left: -202px;
  font-family: var(--boca-font);
}

div#normal {
  width: 100%;
  height: 100%;
  opacity: 0.95;
  top: 0;
  left: 0;
  display: none;
  position: fixed;
  background-color: #0f172a;
  overflow: auto;
}

DIV.menu {
  background-color: <?php echo $corfundo?>;
  layer-background-color: <?php echo $corfundo?>;
}

DIV.menudown {
  background-color: <?php echo $cormenu?>;
  border-bottom: 1px solid var(--boca-border);
  border-right: 1px solid var(--boca-border);
  border-top: 1px solid #fff;
  border-left: 1px solid #fff;
}

DIV.fname {
  background-color: <?php echo $corfundo2?>;
  layer-background-color: <?php echo $corfundo2?>;
  position: absolute;
  visibility: hidden;
  border: 0;
  left: 0px;
  top: 0px;
  height: 19px;
  z-index: 100;
}

DIV.dir {
  background-color: <?php echo $corfundo?>;
  layer-background-color: <?php echo $corfundo?>;
  position: absolute;
  visibility: hidden;
  border: 0;
  left: 0px;
  top: 0px;
  height: 19px;
  z-index: 100;
}

A {
  font-family: var(--boca-font);
  font-size: 14px;
  color: var(--boca-text);
  text-decoration: underline;
  text-decoration-color: #cbd5e1;
}

A:hover {
  color: var(--boca-accent);
  text-decoration-color: var(--boca-accent);
}

A.header {
  font-family: var(--boca-font);
  font-size: 14px;
}

A.menu {
  font-family: var(--boca-font);
  text-decoration: none;
  font-size: 13px;
  font-weight: 600;
  color: var(--boca-text);
  border: 1px solid transparent;
  border-radius: var(--boca-radius);
  padding: 6px 12px;
  display: inline-block;
}

A.menu:hover {
  background-color: var(--boca-accent-soft);
  color: var(--boca-accent);
  border-color: transparent;
}

A.user {
  font-family: var(--boca-font);
  font-size: 14px;
}

A.user:hover {
  font-weight: bolder;
}

A.disabled {
  font-family: var(--boca-font);
  font-size: 14px;
  text-decoration: none;
  color: #94a3b8;
}

A.form {
  font-family: var(--boca-font);
  font-size: 14px;
  background-color: <?php echo $cormenu?>;
}

BODY {
  background-color: var(--boca-bg);
  font-family: var(--boca-font);
  font-size: 14px;
  line-height: 1.45;
  color: var(--boca-text);
  margin: 0;
  padding: 0 12px 24px;
}

BODY.boca-login {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  padding: 0;
}

BODY.cline {
  background-color: #0f172a;
  color: #f8fafc;
}

TABLE {
  font-family: var(--boca-mono);
  font-size: 13px;
  border-collapse: collapse;
}

TABLE.form {
  font-family: var(--boca-font);
  font-size: 14px;
}

TABLE[border="1"], table[border="1"] {
  border: 1px solid var(--boca-border) !important;
}

TABLE[border="1"] td, TABLE[border="1"] th,
table[border="1"] td, table[border="1"] th {
  border: 1px solid var(--boca-border);
  padding: 6px 8px;
}

FORM {
  font-size: 14px;
}

FORM.alt {
  font-size: 14px;
  margin-top: 8px;
}

FORM.fname {
  font-size: 14px;
  margin: 0px;
}

INPUT.fname {
  font-family: var(--boca-mono);
  font-size: 13px;
  border: 0;
  background-color: <?php echo $corfundo2?>;
}

FORM.dir {
  font-size: 14px;
  margin: 0px;
}

INPUT.dir {
  font-family: var(--boca-mono);
  font-size: 13px;
  border: 0;
  background-color: <?php echo $corfundo?>;
}

<?php if( strstr(getenv("HTTP_USER_AGENT"), "MSIE")) { ?>
input.checkbox { border:none }
<?php } else { ?>
input.checkbox { }
<?php } ?>

INPUT {
  font-family: var(--boca-font);
  font-size: 14px;
  border: 1px solid var(--boca-border);
  border-radius: var(--boca-radius);
  padding: 6px 10px;
  background: var(--boca-surface);
  color: var(--boca-text);
}

INPUT[type="submit"], INPUT[type="button"], button {
  background: var(--boca-accent);
  color: #fff;
  border-color: var(--boca-accent);
  cursor: pointer;
  font-weight: 600;
}

INPUT[type="submit"]:hover, INPUT[type="button"]:hover, button:hover {
  background: #1d4ed8;
  border-color: #1d4ed8;
}

INPUT.cline {
  background-color: #0f172a;
  font-family: var(--boca-mono);
  font-size: 14px;
  color: #f8fafc;
  border: 0;
}

TEXTAREA {
  border: 1px solid var(--boca-border);
  border-radius: var(--boca-radius);
  padding: 8px;
  font-family: var(--boca-mono);
  font-size: 13px;
  background: var(--boca-surface);
}

TEXTAREA.edit {
  font-family: var(--boca-mono);
  font-size: 12px;
  background-color: #f8fafc;
}

SELECT {
  font-family: var(--boca-font);
  font-size: 14px;
  border: 1px solid var(--boca-border);
  border-radius: var(--boca-radius);
  padding: 5px 8px;
  background: var(--boca-surface);
}

p.link a:hover {
  background-color: #1e293b;
  color: #fff;
}

p.link a:link span {
  display: none;
}

p.link a:visited span {
  display: none;
}

p.link a:hover span {
  position: absolute;
  margin: 15px 0px 0px 20px;
  background-color: #fefce8;
  max-width: 220px;
  padding: 6px 10px;
  border: 1px solid var(--boca-border);
  font: normal 11px/1.4 var(--boca-font);
  color: var(--boca-text);
  text-align: left;
  display: block;
  border-radius: 4px;
}

/* Top bar (role-colored strip, simplified from contest UIs) */
table.boca-banner {
  width: 100%;
  border: 0;
  border-collapse: collapse;
  margin: 0 0 12px 0;
  background: var(--boca-surface);
  box-shadow: 0 1px 0 var(--boca-border);
  border-radius: 0 0 var(--boca-radius) var(--boca-radius);
}

table.boca-banner td {
  padding: 10px 14px;
  vertical-align: middle;
  border: 0;
  font-family: var(--boca-font);
  font-size: 14px;
  color: var(--boca-text);
}

table.boca-banner td:first-child {
  width: 1%;
  white-space: nowrap;
  text-align: center;
  font-weight: 700;
  letter-spacing: 0.02em;
}

table.boca-banner--team td {
  background: #e8eef9;
}

table.boca-banner--judge td {
  background: #d8f0e4;
}

table.boca-banner--judge-chief td {
  background: #bfe6d0;
}

table.boca-banner--admin td,
table.boca-banner--system td,
table.boca-banner--report td {
  background: #fef3c7;
}

table.boca-banner--staff td {
  background: #ffedd5;
}

table.boca-banner--score td {
  background: #ede9fe;
}

table.boca-banner font,
table.boca-banner a {
  color: var(--boca-text) !important;
  font-family: var(--boca-font);
  font-weight: 700;
}

table.boca-nav {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 16px;
  background: var(--boca-surface);
  border: 1px solid var(--boca-border);
  border-radius: var(--boca-radius);
}

table.boca-nav td {
  padding: 8px 4px;
  text-align: center;
  border: 0;
}

/* Login */
.boca-login-wrap {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 32px 16px;
}

.boca-login-card {
  background: var(--boca-surface);
  border: 1px solid var(--boca-border);
  border-radius: 10px;
  padding: 28px 32px 32px;
  box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
  max-width: 420px;
  width: 100%;
}

.boca-login-card h1 {
  font-family: var(--boca-font);
  font-size: 1.35rem;
  font-weight: 700;
  margin: 0 0 6px;
  color: var(--boca-text);
  text-align: center;
}

.boca-login-card .boca-login-sub {
  font-size: 13px;
  color: var(--boca-muted);
  text-align: center;
  margin: 0 0 22px;
}

.boca-login-card table {
  font-family: var(--boca-font);
  width: 100%;
}

.boca-login-card td {
  padding: 6px 8px 6px 0;
  font-size: 14px;
  color: var(--boca-text);
}

.boca-login-card label {
  font-weight: 500;
  color: var(--boca-muted);
}

.boca-login-card input[type="text"],
.boca-login-card input[type="password"] {
  width: 100%;
  box-sizing: border-box;
  max-width: 220px;
}

.boca-login-actions {
  margin-top: 18px;
  text-align: center;
}

.boca-footnote {
  margin-top: auto;
  padding: 16px;
  text-align: center;
  font-size: 11px;
  color: var(--boca-muted);
}

.boca-footnote hr {
  border: 0;
  border-top: 1px solid var(--boca-border);
  margin: 0 0 12px;
}
