<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientDocumentRequestController extends Controller
{
    public function create(Client $client)
    {
        $documentTypes = [
            'acta_nacimiento' => 'Acta de nacimiento',
            'curp' => 'CURP',
            'rfc' => 'RFC',
            'ine_frente' => 'INE Frente',
            'ine_reverso' => 'INE Reverso',
            'comprobante_domicilio' => 'Comprobante de domicilio',
            'acta_matrimonio' => 'Acta de matrimonio',
            'acta_divorcio' => 'Acta de divorcio',
            'pasaporte' => 'Pasaporte',
            'visa' => 'Visa',
            'cartilla_militar' => 'Cartilla militar',
            'titulo_profesional' => 'Título profesional',
            'cedula_profesional' => 'Cédula profesional',
            'estado_cuenta' => 'Estado de cuenta',
            'contrato_arrendamiento' => 'Contrato de arrendamiento',
            'constancia_situacion_fiscal' => 'Constancia situación fiscal',
            'escrituras' => 'Escrituras',
            'poder_notarial' => 'Poder notarial',
            'acta_defuncion' => 'Acta de defunción',
            'otros' => 'Otro documento',
        ];

        return view('clients.documents', compact('client', 'documentTypes'));
    }

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'documents.*.type' => 'required|string',
            'documents.*.file' => 'required|file|max:10240',
        ]);

        foreach ($request->documents as $doc) {

            $path = $doc['file']->store('client-documents', 'public');

            ClientDocument::create([
                'client_id' => $client->id,
                'document_type' => $doc['type'],
                'document_name' => $doc['file']->getClientOriginalName(),
                'document_path' => $path,
            ]);
        }

        return back()->with('success', 'Documentos enviados correctamente.');
    }
}