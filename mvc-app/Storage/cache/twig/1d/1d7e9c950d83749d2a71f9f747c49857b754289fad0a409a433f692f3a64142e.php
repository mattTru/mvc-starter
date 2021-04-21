<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* layout.html.twig */
class __TwigTemplate_9ee44ffa76d4d3f81cc85540bf9cd43d1b423b1220a1e88ec04c5eb9593b6563 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'additional_css' => [$this, 'block_additional_css'],
            'content' => [$this, 'block_content'],
            'additional_js' => [$this, 'block_additional_js'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
\t<head>
\t\t<meta charset=\"utf-8\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
\t\t<title>
\t\t\t";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        // line 8
        echo "\t\t</title>

\t\t";
        // line 11
        echo "
\t\t";
        // line 13
        echo "\t\t<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), ["/css/styles.css"]), "html", null, true);
        echo "\">
\t\t";
        // line 14
        $this->displayBlock('additional_css', $context, $blocks);
        // line 15
        echo "\t</head>
\t<body>
\t\t";
        // line 18
        echo "\t\t<header></header>

\t\t";
        // line 21
        echo "\t\t<main>
\t\t\t";
        // line 22
        $this->displayBlock('content', $context, $blocks);
        // line 23
        echo "\t\t</main>

\t\t";
        // line 26
        echo "\t\t<footer></footer>

\t\t";
        // line 29
        echo "\t\t<script src=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), ["/js/script.js"]), "html", null, true);
        echo "\"></script>
\t\t";
        // line 30
        $this->displayBlock('additional_js', $context, $blocks);
        // line 31
        echo "\t</body>
</html>
";
    }

    // line 7
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 14
    public function block_additional_css($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 22
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 30
    public function block_additional_js($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 30,  111 => 22,  105 => 14,  99 => 7,  93 => 31,  91 => 30,  86 => 29,  82 => 26,  78 => 23,  76 => 22,  73 => 21,  69 => 18,  65 => 15,  63 => 14,  58 => 13,  55 => 11,  51 => 8,  49 => 7,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
\t<head>
\t\t<meta charset=\"utf-8\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
\t\t<title>
\t\t\t{% block title %}{% endblock %}
\t\t</title>

\t\t{# Favicons #}

\t\t{# CSS #}
\t\t<link rel=\"stylesheet\" href=\"{{ asset('/css/styles.css')}}\">
\t\t{% block additional_css %}{% endblock %}
\t</head>
\t<body>
\t\t{# Header #}
\t\t<header></header>

\t\t{# Main #}
\t\t<main>
\t\t\t{% block content %}{% endblock %}
\t\t</main>

\t\t{# Footer #}
\t\t<footer></footer>

\t\t{# JavaScript #}
\t\t<script src=\"{{ asset('/js/script.js') }}\"></script>
\t\t{% block additional_js %}{% endblock %}
\t</body>
</html>
", "layout.html.twig", "D:\\xampp-www\\mvc-starter\\mvc-app\\Views\\layout.html.twig");
    }
}
