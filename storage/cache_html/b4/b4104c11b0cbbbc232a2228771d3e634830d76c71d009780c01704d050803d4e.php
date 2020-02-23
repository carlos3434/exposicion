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

/* invoice.html.twig */
class __TwigTemplate_d27180538edc26bb8e1d671d992b61485631ea24f1e1edf96e9346a9790e33a4 extends \Twig\Template
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
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    <style type=\"text/css\">
        ";
        // line 5
        $this->loadTemplate("assets/style.css", "invoice.html.twig", 5)->display($context);
        // line 6
        echo "    </style>
</head>
<body class=\"white-bg\">
";
        // line 9
        $context["cp"] = twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 9, $this->source); })()), "company", [], "any", false, false, false, 9);
        // line 10
        $context["isNota"] = twig_in_filter(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 10, $this->source); })()), "tipoDoc", [], "any", false, false, false, 10), [0 => "07", 1 => "08"]);
        // line 11
        $context["isAnticipo"] = (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "totalAnticipos", [], "any", true, true, false, 11) && (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 11, $this->source); })()), "totalAnticipos", [], "any", false, false, false, 11) > 0));
        // line 12
        $context["name"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 12, $this->source); })()), "tipoDoc", [], "any", false, false, false, 12), "01");
        // line 13
        echo "<table width=\"100%\">
    <tbody><tr>
        <td style=\"padding:30px; !important\">
            <table width=\"100%\" height=\"200px\" border=\"0\" aling=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody><tr>
                    <td width=\"50%\" height=\"90\" align=\"center\">
                        <span><img src=\"";
        // line 19
        echo $this->env->getRuntime('Greenter\Report\Filter\ImageFilter')->toBase64(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 19, $this->source); })()), "system", [], "any", false, false, false, 19), "logo", [], "any", false, false, false, 19));
        echo "\" height=\"80\" style=\"text-align:center\" border=\"0\"></span>
                    </td>
                    <td width=\"5%\" height=\"40\" align=\"center\"></td>
                    <td width=\"45%\" rowspan=\"2\" valign=\"bottom\" style=\"padding-left:0\">
                        <div class=\"tabla_borde\">
                            <table width=\"100%\" border=\"0\" height=\"200\" cellpadding=\"6\" cellspacing=\"0\">
                                <tbody><tr>
                                    <td align=\"center\">
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:29px\" text-align=\"center\">";
        // line 27
        echo (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 27, $this->source); })());
        echo "</span>
                                        <br>
                                        <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:19px\" text-align=\"center\">E L E C T R Ó N I C A</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        <span style=\"font-size:15px\" text-align=\"center\">R.U.C.: ";
        // line 39
        echo twig_get_attribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 39, $this->source); })()), "ruc", [], "any", false, false, false, 39);
        echo "</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"center\">
                                        No.: <span>";
        // line 44
        echo twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 44, $this->source); })()), "serie", [], "any", false, false, false, 44);
        echo "-";
        echo twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 44, $this->source); })()), "correlativo", [], "any", false, false, false, 44);
        echo "</span>
                                    </td>
                                </tr>
                                ";
        // line 47
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 47), "resolucion", [], "any", true, true, false, 47)) {
            // line 48
            echo "                                <tr>
                                    <td align=\"center\">
                                        Nro. R.I. Emisor: <span>";
            // line 50
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 50, $this->source); })()), "user", [], "any", false, false, false, 50), "resolucion", [], "any", false, false, false, 50);
            echo "</span>
                                    </td>
                                </tr>
                                ";
        }
        // line 54
        echo "                                </tbody></table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign=\"bottom\" style=\"padding-left:0\">
                        <div class=\"tabla_borde\">
                            <table width=\"96%\" height=\"100%\" border=\"0\" border-radius=\"\" cellpadding=\"9\" cellspacing=\"0\">
                                <tbody><tr>
                                    <td align=\"center\">
                                        <strong><span style=\"font-size:15px\">";
        // line 64
        echo twig_get_attribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 64, $this->source); })()), "razonSocial", [], "any", false, false, false, 64);
        echo "</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        <strong>Dirección: </strong>";
        // line 69
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["cp"]) || array_key_exists("cp", $context) ? $context["cp"] : (function () { throw new RuntimeError('Variable "cp" does not exist.', 69, $this->source); })()), "address", [], "any", false, false, false, 69), "direccion", [], "any", false, false, false, 69);
        echo "
                                    </td>
                                </tr>
                                <tr>
                                    <td align=\"left\">
                                        ";
        // line 74
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 74, $this->source); })()), "user", [], "any", false, false, false, 74), "header", [], "any", false, false, false, 74);
        echo "
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </td>
                </tr>
                </tbody></table>
            <div class=\"tabla_borde\">
                ";
        // line 83
        $context["cl"] = twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 83, $this->source); })()), "client", [], "any", false, false, false, 83);
        // line 84
        echo "                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody><tr>
                        <td width=\"60%\" align=\"left\"><strong>Razón Social:</strong>  ";
        // line 86
        echo twig_get_attribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 86, $this->source); })()), "rznSocial", [], "any", false, false, false, 86);
        echo "</td>
                        <td width=\"40%\" align=\"left\"><strong>";
        // line 87
        echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(twig_get_attribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 87, $this->source); })()), "tipoDoc", [], "any", false, false, false, 87), "06");
        echo ":</strong>  ";
        echo twig_get_attribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 87, $this->source); })()), "numDoc", [], "any", false, false, false, 87);
        echo "</td>
                    </tr>
                    <tr>
                        <td width=\"60%\" align=\"left\">
                            <strong>Fecha Emisión: </strong>  ";
        // line 91
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 91, $this->source); })()), "fechaEmision", [], "any", false, false, false, 91), "d/m/Y");
        echo "
                            ";
        // line 92
        if ((twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 92, $this->source); })()), "fechaEmision", [], "any", false, false, false, 92), "H:i:s") != "00:00:00")) {
            echo " ";
            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 92, $this->source); })()), "fechaEmision", [], "any", false, false, false, 92), "H:i:s");
            echo " ";
        }
        // line 93
        echo "                            ";
        if ((twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fecVencimiento", [], "any", true, true, false, 93) && twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 93, $this->source); })()), "fecVencimiento", [], "any", false, false, false, 93))) {
            // line 94
            echo "                            <br><br><strong>Fecha Vencimiento: </strong>  ";
            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 94, $this->source); })()), "fecVencimiento", [], "any", false, false, false, 94), "d/m/Y");
            echo "
                            ";
        }
        // line 96
        echo "                        </td>
                        <td width=\"40%\" align=\"left\"><strong>Dirección: </strong>  ";
        // line 97
        if (twig_get_attribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 97, $this->source); })()), "address", [], "any", false, false, false, 97)) {
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["cl"]) || array_key_exists("cl", $context) ? $context["cl"] : (function () { throw new RuntimeError('Variable "cl" does not exist.', 97, $this->source); })()), "address", [], "any", false, false, false, 97), "direccion", [], "any", false, false, false, 97);
        }
        echo "</td>
                    </tr>
                    ";
        // line 99
        if ((isset($context["isNota"]) || array_key_exists("isNota", $context) ? $context["isNota"] : (function () { throw new RuntimeError('Variable "isNota" does not exist.', 99, $this->source); })())) {
            // line 100
            echo "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Tipo Doc. Ref.: </strong>  ";
            // line 101
            echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 101, $this->source); })()), "tipDocAfectado", [], "any", false, false, false, 101), "01");
            echo "</td>
                        <td width=\"40%\" align=\"left\"><strong>Documento Ref.: </strong>  ";
            // line 102
            echo twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 102, $this->source); })()), "numDocfectado", [], "any", false, false, false, 102);
            echo "</td>
                    </tr>
                    ";
        }
        // line 105
        echo "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Tipo Moneda: </strong>  ";
        // line 106
        echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 106, $this->source); })()), "tipoMoneda", [], "any", false, false, false, 106), "021");
        echo " </td>
                        <td width=\"40%\" align=\"left\">";
        // line 107
        if ((twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "compra", [], "any", true, true, false, 107) && twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 107, $this->source); })()), "compra", [], "any", false, false, false, 107))) {
            echo "<strong>O/C: </strong>  ";
            echo twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 107, $this->source); })()), "compra", [], "any", false, false, false, 107);
        }
        echo "</td>
                    </tr>
                    ";
        // line 109
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 109, $this->source); })()), "guias", [], "any", false, false, false, 109)) {
            // line 110
            echo "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Guias: </strong>
                        ";
            // line 112
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 112, $this->source); })()), "guias", [], "any", false, false, false, 112));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 113
                echo "                            ";
                echo twig_get_attribute($this->env, $this->source, $context["guia"], "nroDoc", [], "any", false, false, false, 113);
                echo "&nbsp;&nbsp;
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 114
            echo "</td>
                        <td width=\"40%\"></td>
                    </tr>
                    ";
        }
        // line 118
        echo "                    </tbody></table>
            </div><br>
            ";
        // line 120
        $context["moneda"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 120, $this->source); })()), "tipoMoneda", [], "any", false, false, false, 120), "02");
        // line 121
        echo "            <div class=\"tabla_borde\">
                <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                    <tbody>
                        <tr>
                            <td align=\"center\" class=\"bold\">Cantidad</td>
                            <td align=\"center\" class=\"bold\">Código</td>
                            <td align=\"center\" class=\"bold\">Descripción</td>
                            <td align=\"center\" class=\"bold\">Valor Unitario</td>
                            <td align=\"center\" class=\"bold\">Valor Total</td>
                        </tr>
                        ";
        // line 131
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 131, $this->source); })()), "details", [], "any", false, false, false, 131));
        foreach ($context['_seq'] as $context["_key"] => $context["det"]) {
            // line 132
            echo "                        <tr class=\"border_top\">
                            <td align=\"center\">
                                ";
            // line 134
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, $context["det"], "cantidad", [], "any", false, false, false, 134));
            echo "
                                ";
            // line 135
            echo twig_get_attribute($this->env, $this->source, $context["det"], "unidad", [], "any", false, false, false, 135);
            echo "
                            </td>
                            <td align=\"center\">
                                ";
            // line 138
            echo twig_get_attribute($this->env, $this->source, $context["det"], "codProducto", [], "any", false, false, false, 138);
            echo "
                            </td>
                            <td align=\"center\" width=\"300px\">
                                <span>";
            // line 141
            echo twig_get_attribute($this->env, $this->source, $context["det"], "descripcion", [], "any", false, false, false, 141);
            echo "</span><br>
                            </td>
                            <td align=\"center\">
                                ";
            // line 144
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 144, $this->source); })());
            echo "
                                ";
            // line 145
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, $context["det"], "mtoValorUnitario", [], "any", false, false, false, 145));
            echo "
                            </td>
                            <td align=\"center\">
                                ";
            // line 148
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 148, $this->source); })());
            echo "
                                ";
            // line 149
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, $context["det"], "mtoValorVenta", [], "any", false, false, false, 149));
            echo "
                            </td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['det'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 153
        echo "                    </tbody>
                </table></div>
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody><tr>
                    <td width=\"50%\" valign=\"top\">
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr>
                                <td colspan=\"4\">
                                    <br>
                                    <br>
                                    <span style=\"font-family:Tahoma, Geneva, sans-serif; font-size:12px\" text-align=\"center\"><strong>";
        // line 164
        echo $this->env->getRuntime('Greenter\Report\Filter\ResolveFilter')->getValueLegend(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 164, $this->source); })()), "legends", [], "any", false, false, false, 164), "1000");
        echo "</strong></span>
                                    <br>
                                    <br>
                                    <strong>Información Adicional</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr class=\"border_top\">
                                <td width=\"30%\" style=\"font-size: 10px;\">
                                    LEYENDA:
                                </td>
                                <td width=\"70%\" style=\"font-size: 10px;\">
                                    <p>
                                        ";
        // line 180
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 180, $this->source); })()), "legends", [], "any", false, false, false, 180));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 181
            echo "                                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["leg"], "code", [], "any", false, false, false, 181) != "1000")) {
                // line 182
                echo "                                            ";
                echo twig_get_attribute($this->env, $this->source, $context["leg"], "value", [], "any", false, false, false, 182);
                echo "<br>
                                        ";
            }
            // line 184
            echo "                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 185
        echo "                                    </p>
                                </td>
                            </tr>
                            ";
        // line 188
        if ((isset($context["isNota"]) || array_key_exists("isNota", $context) ? $context["isNota"] : (function () { throw new RuntimeError('Variable "isNota" does not exist.', 188, $this->source); })())) {
            // line 189
            echo "                            <tr class=\"border_top\">
                                <td width=\"30%\" style=\"font-size: 10px;\">
                                    MOTIVO DE EMISIÓN:
                                </td>
                                <td width=\"70%\" style=\"font-size: 10px;\">
                                    ";
            // line 194
            echo twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 194, $this->source); })()), "desMotivo", [], "any", false, false, false, 194);
            echo "
                                </td>
                            </tr>
                            ";
        }
        // line 198
        echo "                            ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 198), "extras", [], "any", true, true, false, 198)) {
            // line 199
            echo "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 199, $this->source); })()), "user", [], "any", false, false, false, 199), "extras", [], "any", false, false, false, 199));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 200
                echo "                                    <tr class=\"border_top\">
                                        <td width=\"30%\" style=\"font-size: 10px;\">
                                            ";
                // line 202
                echo twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 202));
                echo ":
                                        </td>
                                        <td width=\"70%\" style=\"font-size: 10px;\">
                                            ";
                // line 205
                echo twig_get_attribute($this->env, $this->source, $context["item"], "value", [], "any", false, false, false, 205);
                echo "
                                        </td>
                                    </tr>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 209
            echo "                            ";
        }
        // line 210
        echo "                            </tbody>
                        </table>
                        ";
        // line 212
        if ((isset($context["isAnticipo"]) || array_key_exists("isAnticipo", $context) ? $context["isAnticipo"] : (function () { throw new RuntimeError('Variable "isAnticipo" does not exist.', 212, $this->source); })())) {
            // line 213
            echo "                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr>
                                <td>
                                    <br>
                                    <strong>Anticipo</strong>
                                    <br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" style=\"font-size: 10px;\">
                            <tbody>
                            <tr>
                                <td width=\"30%\"><b>Nro. Doc.</b></td>
                                <td width=\"70%\"><b>Total</b></td>
                            </tr>
                            ";
            // line 230
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 230, $this->source); })()), "anticipos", [], "any", false, false, false, 230));
            foreach ($context['_seq'] as $context["_key"] => $context["atp"]) {
                // line 231
                echo "                            <tr class=\"border_top\">
                                <td width=\"30%\">";
                // line 232
                echo twig_get_attribute($this->env, $this->source, $context["atp"], "nroDocRel", [], "any", false, false, false, 232);
                echo "</td>
                                <td width=\"70%\">";
                // line 233
                echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 233, $this->source); })());
                echo " ";
                echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, $context["atp"], "total", [], "any", false, false, false, 233));
                echo "</td>
                            </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atp'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 236
            echo "                            </tbody>
                        </table>
                        ";
        }
        // line 239
        echo "                    </td>
                    <td width=\"50%\" valign=\"top\">
                        <br>
                        <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"table table-valores-totales\">
                            <tbody>
                            ";
        // line 244
        if ((isset($context["isAnticipo"]) || array_key_exists("isAnticipo", $context) ? $context["isAnticipo"] : (function () { throw new RuntimeError('Variable "isAnticipo" does not exist.', 244, $this->source); })())) {
            // line 245
            echo "                                <tr class=\"border_bottom\">
                                    <td align=\"right\"><strong>Total Anticipo:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 247
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 247, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 247, $this->source); })()), "totalAnticipos", [], "any", false, false, false, 247));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 250
        echo "                            ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 250, $this->source); })()), "mtoOperGravadas", [], "any", false, false, false, 250)) {
            // line 251
            echo "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>Op. Gravadas:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 253
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 253, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 253, $this->source); })()), "mtoOperGravadas", [], "any", false, false, false, 253));
            echo "</span></td>
                            </tr>
                            ";
        }
        // line 256
        echo "                            ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 256, $this->source); })()), "mtoOperInafectas", [], "any", false, false, false, 256)) {
            // line 257
            echo "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>Op. Inafectas:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 259
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 259, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 259, $this->source); })()), "mtoOperInafectas", [], "any", false, false, false, 259));
            echo "</span></td>
                            </tr>
                            ";
        }
        // line 262
        echo "                            ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 262, $this->source); })()), "mtoOperExoneradas", [], "any", false, false, false, 262)) {
            // line 263
            echo "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>Op. Exoneradas:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 265
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 265, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 265, $this->source); })()), "mtoOperExoneradas", [], "any", false, false, false, 265));
            echo "</span></td>
                            </tr>
                            ";
        }
        // line 268
        echo "                            <tr>
                                <td align=\"right\"><strong>I.G.V.";
        // line 269
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 269), "numIGV", [], "any", true, true, false, 269)) {
            echo " ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 269, $this->source); })()), "user", [], "any", false, false, false, 269), "numIGV", [], "any", false, false, false, 269);
            echo "%";
        }
        echo ":</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
        // line 270
        echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 270, $this->source); })());
        echo "  ";
        echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 270, $this->source); })()), "mtoIGV", [], "any", false, false, false, 270));
        echo "</span></td>
                            </tr>
                            ";
        // line 272
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 272, $this->source); })()), "mtoISC", [], "any", false, false, false, 272)) {
            // line 273
            echo "                            <tr>
                                <td align=\"right\"><strong>I.S.C.:</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 275
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 275, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 275, $this->source); })()), "mtoISC", [], "any", false, false, false, 275));
            echo "</span></td>
                            </tr>
                            ";
        }
        // line 278
        echo "                            ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 278, $this->source); })()), "sumOtrosCargos", [], "any", false, false, false, 278)) {
            // line 279
            echo "                                <tr>
                                    <td align=\"right\"><strong>Otros Cargos:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 281
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 281, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 281, $this->source); })()), "sumOtrosCargos", [], "any", false, false, false, 281));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 284
        echo "                            ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 284, $this->source); })()), "icbper", [], "any", false, false, false, 284)) {
            // line 285
            echo "                                <tr>
                                    <td align=\"right\"><strong>I.C.B.P.E.R.:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 287
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 287, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 287, $this->source); })()), "icbper", [], "any", false, false, false, 287));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 290
        echo "                            ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 290, $this->source); })()), "mtoOtrosTributos", [], "any", false, false, false, 290)) {
            // line 291
            echo "                                <tr>
                                    <td align=\"right\"><strong>Otros Tributos:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 293
            echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 293, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 293, $this->source); })()), "mtoOtrosTributos", [], "any", false, false, false, 293));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 296
        echo "                            <tr>
                                <td align=\"right\"><strong>Precio Venta:</strong></td>
                                <td width=\"120\" align=\"right\"><span id=\"ride-importeTotal\" class=\"ride-importeTotal\">";
        // line 298
        echo (isset($context["moneda"]) || array_key_exists("moneda", $context) ? $context["moneda"] : (function () { throw new RuntimeError('Variable "moneda" does not exist.', 298, $this->source); })());
        echo "  ";
        echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 298, $this->source); })()), "mtoImpVenta", [], "any", false, false, false, 298));
        echo "</span></td>
                            </tr>
                            ";
        // line 300
        if ((twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 300, $this->source); })()), "perception", [], "any", false, false, false, 300) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 300, $this->source); })()), "perception", [], "any", false, false, false, 300), "mto", [], "any", false, false, false, 300))) {
            // line 301
            echo "                                ";
            $context["perc"] = twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 301, $this->source); })()), "perception", [], "any", false, false, false, 301);
            // line 302
            echo "                                ";
            $context["soles"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog("PEN", "02");
            // line 303
            echo "                                <tr>
                                    <td align=\"right\"><strong>Percepción:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 305
            echo (isset($context["soles"]) || array_key_exists("soles", $context) ? $context["soles"] : (function () { throw new RuntimeError('Variable "soles" does not exist.', 305, $this->source); })());
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["perc"]) || array_key_exists("perc", $context) ? $context["perc"] : (function () { throw new RuntimeError('Variable "perc" does not exist.', 305, $this->source); })()), "mto", [], "any", false, false, false, 305));
            echo "</span></td>
                                </tr>
                                <tr>
                                    <td align=\"right\"><strong>Total a Pagar:</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 309
            echo (isset($context["soles"]) || array_key_exists("soles", $context) ? $context["soles"] : (function () { throw new RuntimeError('Variable "soles" does not exist.', 309, $this->source); })());
            echo " ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number(twig_get_attribute($this->env, $this->source, (isset($context["perc"]) || array_key_exists("perc", $context) ? $context["perc"] : (function () { throw new RuntimeError('Variable "perc" does not exist.', 309, $this->source); })()), "mtoTotal", [], "any", false, false, false, 309));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 312
        echo "                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody></table>
            <br>
            <br>
            ";
        // line 319
        if (((isset($context["max_items"]) || array_key_exists("max_items", $context)) && (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 319, $this->source); })()), "details", [], "any", false, false, false, 319)) > (isset($context["max_items"]) || array_key_exists("max_items", $context) ? $context["max_items"] : (function () { throw new RuntimeError('Variable "max_items" does not exist.', 319, $this->source); })())))) {
            // line 320
            echo "                <div style=\"page-break-after:always;\"></div>
            ";
        }
        // line 322
        echo "            <div>
                <hr style=\"display: block; height: 1px; border: 0; border-top: 1px solid #666; margin: 20px 0; padding: 0;\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                    <tbody><tr>
                        <td width=\"85%\">
                            <blockquote>
                                ";
        // line 327
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "user", [], "any", false, true, false, 327), "footer", [], "any", true, true, false, 327)) {
            // line 328
            echo "                                    ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 328, $this->source); })()), "user", [], "any", false, false, false, 328), "footer", [], "any", false, false, false, 328);
            echo "
                                ";
        }
        // line 330
        echo "                                ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "system", [], "any", false, true, false, 330), "hash", [], "any", true, true, false, 330) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 330, $this->source); })()), "system", [], "any", false, false, false, 330), "hash", [], "any", false, false, false, 330))) {
            // line 331
            echo "                                    <strong>Resumen:</strong>   ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["params"]) || array_key_exists("params", $context) ? $context["params"] : (function () { throw new RuntimeError('Variable "params" does not exist.', 331, $this->source); })()), "system", [], "any", false, false, false, 331), "hash", [], "any", false, false, false, 331);
            echo "<br>
                                ";
        }
        // line 333
        echo "                                <span>Representación Impresa de la ";
        echo (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 333, $this->source); })());
        echo " ELECTRÓNICA.</span>
                            </blockquote>
                        </td>
                        <td width=\"15%\" align=\"right\">
                            <img src=\"";
        // line 337
        echo $this->env->getRuntime('Greenter\Report\Filter\ImageFilter')->toBase64($this->env->getRuntime('Greenter\Report\Render\QrRender')->getImage((isset($context["doc"]) || array_key_exists("doc", $context) ? $context["doc"] : (function () { throw new RuntimeError('Variable "doc" does not exist.', 337, $this->source); })())), "png");
        echo "\" alt=\"Qr Image\">
                        </td>
                    </tr>
                    </tbody></table>
            </div>
        </td>
    </tr>
    </tbody></table>
</body></html>
";
    }

    public function getTemplateName()
    {
        return "invoice.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  721 => 337,  713 => 333,  707 => 331,  704 => 330,  698 => 328,  696 => 327,  689 => 322,  685 => 320,  683 => 319,  674 => 312,  666 => 309,  657 => 305,  653 => 303,  650 => 302,  647 => 301,  645 => 300,  638 => 298,  634 => 296,  626 => 293,  622 => 291,  619 => 290,  611 => 287,  607 => 285,  604 => 284,  596 => 281,  592 => 279,  589 => 278,  581 => 275,  577 => 273,  575 => 272,  568 => 270,  560 => 269,  557 => 268,  549 => 265,  545 => 263,  542 => 262,  534 => 259,  530 => 257,  527 => 256,  519 => 253,  515 => 251,  512 => 250,  504 => 247,  500 => 245,  498 => 244,  491 => 239,  486 => 236,  475 => 233,  471 => 232,  468 => 231,  464 => 230,  445 => 213,  443 => 212,  439 => 210,  436 => 209,  426 => 205,  420 => 202,  416 => 200,  411 => 199,  408 => 198,  401 => 194,  394 => 189,  392 => 188,  387 => 185,  381 => 184,  375 => 182,  372 => 181,  368 => 180,  349 => 164,  336 => 153,  326 => 149,  322 => 148,  316 => 145,  312 => 144,  306 => 141,  300 => 138,  294 => 135,  290 => 134,  286 => 132,  282 => 131,  270 => 121,  268 => 120,  264 => 118,  258 => 114,  249 => 113,  245 => 112,  241 => 110,  239 => 109,  231 => 107,  227 => 106,  224 => 105,  218 => 102,  214 => 101,  211 => 100,  209 => 99,  202 => 97,  199 => 96,  193 => 94,  190 => 93,  184 => 92,  180 => 91,  171 => 87,  167 => 86,  163 => 84,  161 => 83,  149 => 74,  141 => 69,  133 => 64,  121 => 54,  114 => 50,  110 => 48,  108 => 47,  100 => 44,  92 => 39,  77 => 27,  66 => 19,  58 => 13,  56 => 12,  54 => 11,  52 => 10,  50 => 9,  45 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoice.html.twig", "/home/vagrant/code/exposicion/vendor/greenter/report/src/Report/Templates/invoice.html.twig");
    }
}
