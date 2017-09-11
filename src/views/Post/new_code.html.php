<?php
$this->layout('layout', [
    'title' => 'New Post',
    'path' => $path,
    'session' => $session,
    'css' => '
<style type="text/css">
</style>',
    'js' => '
<script src="ace/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>

    /** Default ace editor configuration **/
    var editor = ace.edit("editor");
    var textarea = $(\'textarea[name="content"]\');
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/javascript");
    editor.setOptions({
        autoScrollEditorIntoView: true,
        maxLines: 30,
        minLines: 5,
    });
    editor.getSession().on("change", function () {
        textarea.val(editor.getSession().getValue());
        console.log(editor.getSession().getValue());
    });
    
    $("#editor").height(400);
    $("#language").on("change", function () {
        editor.getSession().setMode("ace/mode/" + $(this).val());
    });

</script>'
])
?>
<main class="wrapper aligner publication">
    <div class="content contentFix">
        <form id="post_form" method="POST" action="<?php $path->generateUrl('PostNew', ['type' => 'code']) ?>">
            <div class="post_container">
                <input class="titleInPublish" type="text" name="title" id="title" placeholder="Titre de la publication">
                <div class="zoneDeCode">
                    <div id="editor"></div>
                </div>
                <textarea name="content" cols="30" rows="10" style="display: none"></textarea>
            </div>
            <div class="barPublication">
                <label for="language"></label>
                <select id="language" name="language">
                    <option value="abap">abap</option>
                    <option value="abc">abc</option>
                    <option value="actionscript">actionscript</option>
                    <option value="ada">ada</option>
                    <option value="apache_conf">apache</option>
                    <option value="applescript">applescript</option>
                    <option value="asciidoc">asciidoc</option>
                    <option value="assembly_x86">assembly_x86</option>
                    <option value="autohotkeys">autohotkeys</option>
                    <option value="batchfile">batchfile</option>
                    <option value="behaviour">behaviour</option>
                    <option value="bro">bro</option>
                    <option value="c9search">c9search</option>
                    <option value="c_cpp">c_cpp</option>
                    <option value="clojure">clojure</option>
                    <option value="cobol">cobol</option>
                    <option value="coffee">coffee</option>
                    <option value="coldfusion">Saab</option>
                    <option value="csharp">coldfusion</option>
                    <option value="css">css</option>
                    <option value="curly">curly</option>
                    <option value="d">d</option>
                    <option value="dart">dart</option>
                    <option value="diff">diff</option>
                    <option value="django">django</option>
                    <option value="dockerfile">dockerfile</option>
                    <option value="dot">dot</option>
                    <option value="drools">drools</option>
                    <option value="eiffel">eiffel</option>
                    <option value="elixir">elixir</option>
                    <option value="elm">elm</option>
                    <option value="erlang">erlang</option>
                    <option value="forth">forth</option>
                    <option value="fortran">fortran</option>
                    <option value="ftl">ftl</option>
                    <option value="gcode">gcode</option>
                    <option value="gherkin">gherkin</option>
                    <option value="gitignore">gitignore</option>
                    <option value="glsl">glsl</option>
                    <option value="gobstones">gobstones</option>
                    <option value="golang">golang</option>
                    <option value="graphqlschema">graphqlschema</option>
                    <option value="groovy">groovy</option>
                    <option value="haml">haml</option>
                    <option value="handlebars">handlebars</option>
                    <option value="haskell">haskell</option>
                    <option value="haskell_cabal">haskell_cabal</option>
                    <option value="haxe">haxe</option>
                    <option value="hjson">hjson</option>
                    <option value="html">html</option>
                    <option value="html_elixir">html_elixir</option>
                    <option value="html_ruby">html_ruby</option>
                    <option value="ini">ini</option>
                    <option value="io">io</option>
                    <option value="jack">jack</option>
                    <option value="jade">jade</option>
                    <option value="java">java</option>
                    <option value="javascript">javascript</option>
                    <option value="json">json</option>
                    <option value="jsoniq">jsoniq</option>
                    <option value="jsp">jsp</option>
                    <option value="jsx">jsx</option>
                    <option value="julia">julia</option>
                    <option value="kotlin">kotlin</option>
                    <option value="latex">latex</option>
                    <option value="less">less</option>
                    <option value="liquid">liquid</option>
                    <option value="lisp">lisp</option>
                    <option value="livescript">livescript</option>
                    <option value="logiql">logiql</option>
                    <option value="lsl">lsl</option>
                    <option value="lua">lua</option>
                    <option value="luapage">luapage</option>
                    <option value="lucene">lucene</option>
                    <option value="makefile">makefile</option>
                    <option value="markdown">markdown</option>
                    <option value="mask">mask</option>
                    <option value="matlab">matlab</option>
                    <option value="maze">maze</option>
                    <option value="mel">mel</option>
                    <option value="mushcode">mushcode</option>
                    <option value="mysql">mysql</option>
                    <option value="nix">nix</option>
                    <option value="objectivec">objectivec</option>
                    <option value="ocaml">ocaml</option>
                    <option value="pascal">pascal</option>
                    <option value="perl">perl</option>
                    <option value="pgsql">pgsql</option>
                    <option value="php">php</option>
                    <option value="pig">pig</option>
                    <option value="plain_text">plain_text</option>
                    <option value="powershell">powershell</option>
                    <option value="praat">praat</option>
                    <option value="prolog">prolog</option>
                    <option value="properties">properties</option>
                    <option value="protobuf">protobuf</option>
                    <option value="python">python</option>
                    <option value="r">r</option>
                    <option value="razor">razor</option>
                    <option value="rdoc">rdoc</option>
                    <option value="rhtml">rhtml</option>
                    <option value="rst">rst</option>
                    <option value="ruby">ruby</option>
                    <option value="rust">rust</option>
                    <option value="sass">sass</option>
                    <option value="scad">scad</option>
                    <option value="scala">scala</option>
                    <option value="scheme">scheme</option>
                    <option value="scss">scss</option>
                    <option value="sh">sh</option>
                    <option value="sjs">sjs</option>
                    <option value="smarty">smarty</option>
                    <option value="snippet">snippet</option>
                    <option value="soy_template">soy_template</option>
                    <option value="space">space</option>
                    <option value="sparql">sparql</option>
                    <option value="sql">sql</option>
                    <option value="sqlserver">sqlserver</option>
                    <option value="stylus">stylus</option>
                    <option value="svg">svg</option>
                    <option value="swift">swift</option>
                    <option value="tcl">tcl</option>
                    <option value="tex">tex</option>
                    <option value="text">text</option>
                    <option value="textile">textile</option>
                    <option value="toml">toml</option>
                    <option value="tsx">tsx</option>
                    <option value="turtle">turtle</option>
                    <option value="twig">twig</option>
                    <option value="typescipt">typescipt</option>
                    <option value="vala">vala</option>
                    <option value="vbscript">vbscript</option>
                    <option value="velocity">velocity</option>
                    <option value="verilog">verilog</option>
                    <option value="vhdl">vhdl</option>
                    <option value="wollock">wollock</option>
                    <option value="xml">xml</option>
                    <option value="xquery">xquery</option>
                    <option value="yaml">yaml</option>
                </select>
            </div>
            <div>
                <input class="titleInPublish" type="text" name="tags" placeholder="Ajouter tags, tags, ..." />
            </div>
            <div>
                <button class="editPubli" type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</main>
