<?php
header("Content-Type: text/css; charset=utf-8");
?>
:root {
  --boca-bg: #f4f6fb;
  --boca-text: #1e293b;
  --boca-border: #e2e8f0;
  --boca-font: system-ui, -apple-system, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Arial, sans-serif;
  --boca-mono: ui-monospace, "Cascadia Code", "Source Code Pro", Menlo, Consolas, monospace;
}

body {
  margin: 0;
  padding: 8px;
  font-family: var(--boca-font);
  font-size: 14px;
  line-height: 1.45;
  background: var(--boca-bg);
  color: var(--boca-text);
}

table {
  border-collapse: collapse;
}

table td, table th {
  border: 1px solid var(--boca-border);
  padding: 4px 6px;
}

<?php for($i=1;$i<999;$i++) echo "table.sitehide$i .sitegroup$i { display: none; }\n"; ?>
