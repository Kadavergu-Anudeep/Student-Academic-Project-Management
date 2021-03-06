<!DOCTYPE html>
<html>
<?php 
session_start();
$projectid = $_SESSION['projectid'];
?>

<head>
    <meta charset="UTF-8">

    <meta name="description" content="Free and open-source online code editor that allows you to write and execute code from a rich set of languages.">
    <meta name="keywords" content="online editor, online code editor, online ide, online compiler, online interpreter, run code online, learn programming online,
            online debugger, programming in browser, online code runner, online code execution, debug online, debug C code online, debug C++ code online,
            programming online, snippet, snippets, code snippet, code snippets, pastebin, execute code, programming in browser, run c online, run C++ online,
            run java online, run python online, run ruby online, run c# online, run rust online, run pascal online, run basic online">
    <meta name="author" content="Herman Zvonimir Došilović">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:title" content="Judge0 IDE - Free and open-source online code editor">
    <meta property="og:description" content="Free and open-source online code editor that allows you to write and execute code from a rich set of languages.">
    <meta property="og:image" content="https://raw.githubusercontent.com/judge0/ide/master/.github/wallpaper.png">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/goldenlayout.min.js" integrity="sha256-NhJAZDfGgv4PiB+GVlSrPdh3uc75XXYSM4su8hgTchI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/css/goldenlayout-base.css" integrity="sha256-oIDR18yKFZtfjCJfDsJYpTBv1S9QmxYopeqw2dO96xM=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/css/goldenlayout-dark-theme.css" integrity="sha256-ygw8PvSDJJUGLf6Q9KIQsYR3mOmiQNlDaxMLDOx9xL0=" crossorigin="anonymous" />

    <script>
        var require = {
            paths: {
                "vs": "https://unpkg.com/monaco-editor/min/vs",
                "monaco-vim": "https://unpkg.com/monaco-vim/dist/monaco-vim",
                "monaco-emacs": "https://unpkg.com/monaco-emacs/dist/monaco-emacs"
            }
        };
    </script>
    <script src="https://unpkg.com/monaco-editor/min/vs/loader.js"></script>
    <script src="https://unpkg.com/monaco-editor@0.18.1/min/vs/editor/editor.main.nls.js"></script>
    <script src="https://unpkg.com/monaco-editor@0.18.1/min/vs/editor/editor.main.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

    <script type="text/javascript" src="third_party/download.js"></script>

    <script type="text/javascript" src="js/ide.js"></script>

    <link type="text/css" rel="stylesheet" href="css/ide.css">

    <title>Online code editor</title>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <script type="text/javascript">
        function instruct(){
            window.alert("1.Welcome to Vardhaman Virtual Lab Space.\n 2.Here you can code in many languages and can execute and save in local machine\n 3.Once you saved your code upload into your cloud folder on clicking cloud storage in your student home page such that files can be accessed when needed.")
        }
    </script>
</head>

<body onload=instruct()>
    <div id="site-navigation" class="ui small inverted menu">
        <div id="site-header" class="header item">
           
                
                <h2><?php echo $projectid; ?></h2>
          
        </div>
        <div class="left menu">
            <div class="ui dropdown item site-links on-hover">
                File <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" target="_blank" href="/"><i class="file code icon"></i> New File</a>
                    <div class="item" onclick="save()"><i class="save icon"></i> Save (Ctrl + S)</div>
                    <div class="item" onclick="downloadSource()"><i class="download icon"></i> Download</div>
                    <!-- <div class="item"><i class="share icon"></i> Share</div> -->
                    <div id="insert-template-btn" class="item"><i class="file code outline icon"></i> Insert template
                        for current language</div>
                </div>
            </div>
            <div class="link item" onclick="$('#site-settings').modal('show')"><i class="cog icon"></i> Settings</div>
            <div class="item borderless">
                <select id="select-language" class="ui dropdown">
                    <option value="45" mode="UNKNOWN">Assembly (NASM 2.14.02)</option> <!-- Unknown mode. Help needed. -->
                    <option value="46" mode="shell">Bash (5.0.0)</option>
                    <option value="47" mode="UNKNOWN">Basic (FBC 1.07.1)</option> <!-- Unknown mode. Help needed. -->
                    <option value="48" mode="c">C (GCC 7.4.0)</option>
                    <option value="49" mode="c">C (GCC 8.3.0)</option>
                    <option value="50" mode="c">C (GCC 9.2.0)</option>
                    <option value="51" mode="csharp">C# (Mono 6.6.0.161)</option>
                    <option value="52" mode="cpp">C++ (GCC 7.4.0)</option>
                    <option value="53" mode="cpp">C++ (GCC 8.3.0)</option>
                    <option value="54" mode="cpp">C++ (GCC 9.2.0)</option>
                    <option value="55" mode="UNKNOWN">Common Lisp (SBCL 2.0.0)</option> <!-- Unknown mode. Help needed. -->
                    <option value="56" mode="UNKNOWN">D (DMD 2.089.1)</option> <!-- Unknown mode. Help needed. -->
                    <option value="57" mode="UNKNOWN">Elixir (1.9.4)</option> <!-- Unknown mode. Help needed. -->
                    <option value="58" mode="UNKNOWN">Erlang (OTP 22.2)</option> <!-- Unknown mode. Help needed. -->
                    <option value="44" mode="plaintext">Executable</option>
                    <option value="59" mode="UNKNOWN">Fortran (GFortran 9.2.0)</option> <!-- Unknown mode. Help needed. -->
                    <option value="60" mode="go">Go (1.13.5)</option>
                    <option value="61" mode="UNKNOWN">Haskell (GHC 8.8.1)</option> <!-- Unknown mode. Help needed. -->
                    <option value="62" mode="java">Java (OpenJDK 13.0.1)</option>
                    <option value="63" mode="javascript">JavaScript (Node.js 12.14.0)</option>
                    <option value="64" mode="lua">Lua (5.3.5)</option>
                    <option value="1000" mode="python">Nim (stable)</option> <!-- Replacement mode. Help needed. -->
                    <option value="65" mode="UNKNOWN">OCaml (4.09.0)</option> <!-- Unknown mode. Help needed. -->
                    <option value="66" mode="UNKNOWN">Octave (5.1.0)</option> <!-- Unknown mode. Help needed. -->
                    <option value="67" mode="pascal">Pascal (FPC 3.0.4)</option>
                    <option value="68" mode="php">PHP (7.4.1)</option>
                    <option value="43" mode="plaintext">Plain Text</option>
                    <option value="69" mode="UNKNOWN">Prolog (GNU Prolog 1.4.5)</option> <!-- Unknown mode. Help needed. -->
                    <option value="70" mode="python">Python (2.7.17)</option>
                    <option value="71" mode="python">Python (3.8.1)</option>
                    <option value="72" mode="ruby">Ruby (2.7.0)</option>
                    <option value="73" mode="rust">Rust (1.40.0)</option>
                    <option value="74" mode="rust">TypeScript (3.7.4)</option>
                    <option value="1001" mode="rust">V (latest)</option> <!-- Replacement mode. Help needed. -->
                </select>
            </div>
            <div class="item fitted borderless">
                <div class="ui input">
                    <input id="compiler-options" type="text" placeholder="Compiler options"></input>
                </div>
            </div>
            <div class="item borderless">
                <div class="ui input">
                    <input id="command-line-arguments" type="text" placeholder="Command line arguments"></input>
                </div>
            </div>
            <div class="item no-left-padding borderless">
                <button id="run-btn" class="ui primary labeled icon button"><i class="play icon"></i>Run (F9)</button>
            </div>
            <div id="navigation-message" class="item borderless">
                <span class="navigation-message-text"></span>
            </div>
        </div>
        
    </div>

    <div id="site-content"></div>

    <div id="site-modal" class="ui modal">
        <div class="header">
            <i class="close icon"></i>
            <span id="title"></span>
        </div>
        <div class="scrolling content"></div>
        <div class="actions">
            <div class="ui small labeled icon cancel button">
                <i class="remove icon"></i>
                Close (ESC)
            </div>
        </div>
    </div>

    <div id="site-settings" class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            <i class="cog icon"></i>
            Settings
        </div>
        <div class="content">
            <div class="ui form">
                <div class="inline fields">
                    <label>Editor Mode</label>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="editor-mode" value="normal" checked="checked">
                            <label>Normal</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="editor-mode" value="vim">
                            <label>Vim</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="editor-mode" value="emacs">
                            <label>Emacs</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="site-footer">
        <span id="donate-line">
            <a class="item" target="_blank" href="https://www.patreon.com/hermanzdosilovic"><i class="patreon icon" style="color: #f06553;"></i> Become a Patron</a>
            ·
            <a class="item" target="_blank" href="https://paypal.me/hermanzdosilovic"><i class="paypal icon" style="color: #00457c;"></i></i> Donate with PayPal</a>
        </span>
        <div id="editor-status-line"></div>
        <span>© 2016-2020 <a href="https://judge0.com">Judge0</a> · Powered by <a href="https://api.judge0.com">Judge0
                API</a> · Source code available on <a href="https://github.com/judge0/ide">GitHub</a></span>
        <span id="status-line"></span>
    </div>
</body>

</html>
