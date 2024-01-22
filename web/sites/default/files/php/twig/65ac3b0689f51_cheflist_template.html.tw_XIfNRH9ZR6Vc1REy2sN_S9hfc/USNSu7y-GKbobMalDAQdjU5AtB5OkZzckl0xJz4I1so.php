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

/* modules/custom/second_module/templates/cheflist_template.html.twig */
class __TwigTemplate_6c53d220a7961d1ce0f7d5b7d3b7ccb4 extends \Twig\Template
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
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["listForm"] ?? null), 1, $this->source), "html", null, true);
        echo "


<table>
  <thead>
    <tr>
      <th scope=\"col\">Dish</th>
      <th scope=\"col\">Ingredients</th>
      <th scope=\"col\">Prep Time</th>
       <th scope=\"col\">Image</th>
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
            // line 18
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "field_dish", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
            echo "</td>
      <td>";
            // line 19
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "field_ingredients", [], "any", false, false, true, 19), 19, $this->source), "html", null, true);
            echo "</td>
      <td>";
            // line 20
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "field_preptime", [], "any", false, false, true, 20), 20, $this->source), "html", null, true);
            echo "</td>
    <td>
    <img src=\"";
            // line 22
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "field_recipe_image", [], "any", false, false, true, 22), 22, $this->source), "html", null, true);
            echo "\" alt=\"Recipe Image\" style=\"width: 50px; height: 50px;\"/>
    </td>
    </tr>
    
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "    
  </tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "modules/custom/second_module/templates/cheflist_template.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 27,  77 => 22,  72 => 20,  68 => 19,  64 => 18,  59 => 15,  55 => 14,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/second_module/templates/cheflist_template.html.twig", "C:\\laragon\\www\\drupaldemo\\web\\modules\\custom\\second_module\\templates\\cheflist_template.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 14);
        static $filters = array("escape" => 1);
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
