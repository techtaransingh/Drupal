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

/* modules/custom/service_module/templates/event_list_template.html.twig */
class __TwigTemplate_4a4a21d268b181898c64d88098b167f6 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "

<table>
  <thead>
    <tr>
      <th scope=\"col\">Event Name</th>
      <th scope=\"col\">Date</th>
       <th scope=\"col\">Venue</th>
        <th scope=\"col\">Action through service</th>
        <th scope=\"col\">Current date</th>
    </tr>
  </thead>
  <tbody>
   ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 15
            echo "   
    <tr>
      <td>";
            // line 17
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "event_name", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
            echo "</td>
      <td>";
            // line 18
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "date", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
            echo "</td>
      <td>";
            // line 19
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "venue", [], "any", false, false, true, 19), 19, $this->source), "html", null, true);
            echo "</td>
      <td>";
            // line 20
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "date_check", [], "any", false, false, true, 20), 20, $this->source), "html", null, true);
            echo "</td>
<td>";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "today", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo "</td>
    </tr>
    
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "    
  </tbody>
</table>

";
    }

    public function getTemplateName()
    {
        return "modules/custom/service_module/templates/event_list_template.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 25,  78 => 21,  74 => 20,  70 => 19,  66 => 18,  62 => 17,  58 => 15,  54 => 14,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/service_module/templates/event_list_template.html.twig", "C:\\laragon\\www\\drupaldemo\\web\\modules\\custom\\service_module\\templates\\event_list_template.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 14);
        static $filters = array("escape" => 17);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
